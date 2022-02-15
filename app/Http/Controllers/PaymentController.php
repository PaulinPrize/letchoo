<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\UserInvitation;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
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

    public function create(Request $request){
        /*
        $data = json_decode($request->getContent(), true);
        $provider = \PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);
        $amount = 

        $order = $provider->createOrder([
            "intent"=> "CAPTURE",
            "purchase_units"=> [
                 [
                    "amount"=> [
                        "currency_code"=> "USD",
                        "value"=> $data['amount']
                    ],
                    'menu' => 'menu'
                ]
            ],
        ]);

        return response()->json($order);
        */
        //return redirect()->route('payments.my-payments');
    }

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
}
