<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\{ Order, Transaction, UserInvitation, Invitation, Bonus };
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{

    private $paypalClient;

    public function __construct(PayPalClient $paypalClient) {
        $this->paypalClient = $paypalClient;
    }
    
    // Fonction permettant d'afficher tous les paiements effectués à l'admin
    public function index(){
        // $allPayments = UserInvitation::all();
        $allPayments = DB::table('invitation_user')
        ->select('id','updated_at', 'payment_method', 'payment_status','user_id', 'subscriber_name', 'invitation_id', 'menu', 'amount', 'currency', 'reference_number')
        ->where('invoice_paid', '=', 1)
        ->get();
        return view('payments.index', compact('allPayments'));
    }

    // Fonction permettant d'afficher tous les paiements effectués par un utilisateur
    public function myPayments(){
        $user =  Auth::user()->id;
        $myPayments =DB::table('invitation_user')
        ->select('updated_at', 'payment_method', 'payment_status', 'user_id', 'subscriber_name', 'invitation_id', 'menu', 'amount', 'currency', 'reference_number')
        ->where('invoice_paid', '=', 1)
        ->where('user_id', $user)
        ->paginate(10);
        return view('payments.my-payments', compact('myPayments'));
    }

    // Fonction permettant d'afficher les revenus d'un utilisateur
    public function myIncome(){
        $user =  Auth::user()->id;
        $myIncomes =DB::table('invitation_user')
        ->select('updated_at', 'payment_method', 'payment_status', 'owner_id', 'subscriber_name', 'invitation_id', 'menu', 'amount', 'currency', 'reference_number')
        ->where('invoice_paid', '=', 1)
        ->where('payment_status', '=', 1)
        ->where('owner_id', $user)
        ->paginate(10);
        return view('payments/my-income', compact('myIncomes'));
    }

    public function create(Request $request) {
       

        $data = json_decode($request->getContent(), true);

        $this->paypalClient->setApiCredentials(config('paypal'));
        $token = $this->paypalClient->getAccessToken();
        $this->paypalClient->setAccessToken($token);
        
        $order = $this->paypalClient->createOrder([
            "intent"=> "CAPTURE",
            "purchase_units"=> [
                 [
                    "amount"=> [
                        "currency_code" => $data['currency_code'],
                        "value" => $data['amount']
                    ],
                    'description' => 'test'
                ]
            ],
        ]);
          
        $mergeData = array_merge($data,[
            'status' => config('constants.options.operation_pending'),
            'vendor_order_id' => $order['id'],
            'amount' => $data['amount'],
            'currency_code' => $data['currency_code']
        ]);
        
        DB::beginTransaction();
            Order::create($mergeData);
        DB::commit();

        return response()->json($order);
        
        //return redirect()->route('payments.my-payments');
    }

    public function capture(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $orderId = $data['orderId'];
        $this->paypalClient->setApiCredentials(config('paypal'));
        $token = $this->paypalClient->getAccessToken();
        $this->paypalClient->setAccessToken($token);
        $result = $this->paypalClient->capturePaymentOrder($orderId);

//            $result = $result->purchase_units[0]->payments->captures[0];
        try {
            DB::beginTransaction();

            if($result['status'] === "COMPLETED") {
                
                $transaction = new Transaction;
                $transaction->vendor_payment_id = $orderId;
                $transaction->invitation_id  = $data['invitation_id'];
                $transaction->user_id = $data['user_id'];
                $transaction->status = config('constants.options.operation_completed');
                $transaction->save();
                $order = Order::where('vendor_order_id', $orderId)->first();
                $order->transaction_id = $transaction->id;
                $order->status = config('constants.options.operation_completed');
                $order->save();

                //search invitation
                $invitation = Invitation::findOrFail($data['invitation_id']);
                
                if ($invitation && !$invitation->direct_payment && !$request->filled('type')) {

                    $found_user_invitation = UserInvitation::where([
                        ['invitation_id', $data['invitation_id']],
                        ['user_id', $data['user_id']],
                    ])->first();

                    //check if user invitation exists
                    if ($found_user_invitation) {

                        $found_user_invitation->update([
                            'payment_status' => true,
                            'invoice_paid' => true,
                        ]);

                    }

                } 

                if($data['type'] && $data['type'] === "bonus") {

                    Bonus::create([
                        "invitation_id" => $data['invitation_id'],
                        "user_id" => $data['user_id'],
                        "amount" => $order->amount,
                        "currency" => $order->currency_code
                    ]);

                }

                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return response()->json($result);
    }
    /*
    public function processPaypalPayment(Request $request){
        $payment = new Payment();

        $payment->invitation_user_id = $request->input('invitation_user_id');
        $payment->paid_by = $request->input('paid_by');
        $payment->payer_id = $request->input('payer_id');
        $payment->amount = $request->input('amount');
        $payment->currency = $request->input('currency');
        
        $payment->payment_method = $request->input('payment_method');

        $payment->save();

        return redirect()->route('payments.my-payments')->with('info', 'Le paiement a été enregistré et est en attente de validation par nos services');  
    }
    */
}
