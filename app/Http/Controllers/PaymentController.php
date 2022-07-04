<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\{ Order, Transaction, UserInvitation, Invitation, Bonus, User };
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Carbon\Carbon;


class PaymentController extends Controller
{

    private $paypalClient;
  
    public function __construct(PayPalClient $paypalClient) {
        $this->paypalClient = $paypalClient;
    }
    
    // Fonction permettant d'afficher toutes les tables qui ont reçu des paiements à l'admin
    public function index(){

        // Récupérer uniquement les invitations avec leurs transactions 
        $allPayments = DB::table('invitations')
        ->join('users', 'invitations.user_id', '=', 'users.id')
        ->join('transactions', 'invitations.id', '=', 'transactions.invitation_id')
        ->select('transactions.*', 'invitations.*', 'users.*', DB::raw('COUNT(transactions.id) as counting'))
        ->where('status', 'COMPLETED')
        ->where('transaction_type', 'Payment')
        ->groupBy('transactions.invitation_id')
        ->get();

        return view('payments.index', compact('allPayments'));
    }

    // Afficher les détails des paiements d'une table
    public function paymentDetail($id){

        $payment = DB::table('invitations')
        ->join('transactions', 'transactions.invitation_id', 'invitations.id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->join('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->where('invitations.id', $id)
        ->get();

        // Faire la somme des montants de toutes les transactions (pourboires compris)
        $totalAmount = $payment->sum('amount');

        $currency;
        $amountToBePaidToTheHost;
        $taxIncome;
        $income;

        $details = DB::table('invitations')
        ->join('transactions', function($join){
            $join->on('transactions.invitation_id', '=', 'invitations.id')
            ->where('transaction_type', 'Payment')
            ->where('status', 'COMPLETED');
        })
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->join('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->select(DB::raw('sum(invitations.amountToBePaidToTheHost) as amountToBePaidToTheHost, sum(invitations.taxIncome) as taxIncome, sum(invitations.income) as income, currency'))
        ->where('invitations.id', $id)->get(); 

        foreach($details as $detail) {
            $currency = $detail->currency;
            $amountToBePaidToTheHost = $detail->amountToBePaidToTheHost; 
            $taxIncome = $detail->taxIncome;
            $income = $detail->income;
        } 

        // Montant des pourboires
        $tips = $totalAmount - ($amountToBePaidToTheHost + $taxIncome + $income);

        // Montant total à verser à l'hôte
        $hostIncome = $amountToBePaidToTheHost + $tips;

        return view('payments.payment-details', compact('payment', 'totalAmount', 'currency', 'amountToBePaidToTheHost', 'tips', 'hostIncome', 'taxIncome', 'income'));
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

        return view('payments/my-income', compact('myIncomes'));
    }

    // Afficher les détails des paiements d'une table
    public function incomeDetail($id){

        $income = DB::table('invitations')->select('*')
        ->join('transactions', 'transactions.invitation_id', 'invitations.id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->join('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->where('invitations.id', $id)
        ->where('transactions.transaction_type', 'Payment')
        ->get();

        $tip = DB::table('invitations')->select('*')
        ->join('transactions', 'transactions.invitation_id', 'invitations.id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->join('orders', 'orders.transaction_id', '=', 'transactions.id')
        ->where('invitations.id', $id)
        ->where('transactions.transaction_type', 'Tip')
        ->get();

        return view('payments.income-details', compact('income', 'tip'));
    }

    // Fonction permettant d'afficher tous les paiements effectués par un utilisateur
    public function myPayments(){

        // Récupérer la date et l'heure du jour
        $getDate = Carbon::now();

        // Extraire la date du jour uniquement
        $today = $getDate->format('Y-m-d');
        
        $myPayments = DB::table('orders')->select('*')
        ->join('transactions', function($join){
            $user =  Auth::user()->id;
            $join->on('transactions.id', '=', 'orders.transaction_id')
            ->where('user_id', $user);
        })
        ->join('invitations',  'invitations.id', '=', 'transactions.invitation_id')
        ->paginate(8);

        //dd($myPayments);

        return view('payments.my-payments', compact('myPayments', 'today'));
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
