<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\{ Order, Transaction, UserInvitation, Invitation, Bonus, User };
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaymentController extends Controller
{

    private $paypalClient;
  
    public function __construct(PayPalClient $paypalClient) {
        $this->paypalClient = $paypalClient;
    }
    
    // Fonction permettant d'afficher toutes les tables qui ont reçu des paiements à l'admin
    public function index(){
        // Récupérer toutes les invitations avec leurs transactions 
        $allPayments = Invitation::withCount(['transactions' => function($query){
            $query->where('status', 'COMPLETED')
            ->where('transaction_type', 'Payment');
        }])->paginate(5);

        return view('payments.index', compact('allPayments'));
    }

    // Afficher les détails des paiements d'une table
    public function paymentDetail($id){

        $filter = $id;

        $payment = DB::table('invitations')->select('*')
        ->join('transactions', 'transactions.invitation_id', 'invitations.id')
        ->join('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->where('invitations.id', $filter)
        ->get();

        return view('payments.payment-details', compact('payment'));
    }

    // Fonction permettant d'afficher les revenus d'un utilisateur par table
    public function myIncome(){
        $user =  Auth::user()->id;

        $filter1 = "COMPLETED";
        $filter2 = "Payment";

        $myIncomes = Invitation::withCount(['transactions' => function($query) use ($filter1, $filter2){
            $query->where('status', $filter1)
            ->where('transaction_type', $filter2);
        }])->where('user_id', $user)->paginate(5);

        //dd($myIncomes);

        return view('payments/my-income', compact('myIncomes'));
    }

    // Afficher les détails des paiements d'une table
    public function incomeDetail($id){

        $filter = $id;

        $income = DB::table('invitations')->select('*')
        ->join('transactions', 'transactions.invitation_id', 'invitations.id')
        ->join('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->where('invitations.id', $filter)
        ->where('transactions.transaction_type', 'Payment')
        ->get();

        $tip = DB::table('invitations')->select('*')
        ->join('transactions', 'transactions.invitation_id', 'invitations.id')
        ->join('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->where('invitations.id', $filter)
        ->where('transactions.transaction_type', 'Tip')
        ->get();

        return view('payments.income-details', compact('income', 'tip'));
    }

    // Fonction permettant d'afficher tous les paiements effectués par un utilisateur
    public function myPayments(){

        $user =  Auth::user()->id;

        $myPayments = Transaction::where('user_id', $user)->get();

        return view('payments.my-payments', compact('myPayments'));
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

        // $result = $result->purchase_units[0]->payments->captures[0];
        try {
            DB::beginTransaction();

            if($result['status'] === "COMPLETED") {
                
                $transaction = new Transaction;
                $transaction->vendor_payment_id = $orderId;
                $transaction->invitation_id  = $data['invitation_id'];
                $transaction->user_id = $data['user_id']; 
                $transaction->transaction_type = $data['transaction_type']; 
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

                    // check if user invitation exists
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
                        "currency" => $order->currency_code,
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
}
