<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
//use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	// Fonction permettant d'afficher la liste des utilisaeurs
    public function index(){  

        // Compter les utilisateurs
        $countUsers = User::count();
        $widget = [
        	'users' => $countUsers
        ];

        $utilisateurs = User::withTrashed()->paginate(10);		

    	return view('users/index', compact('utilisateurs','widget')); 
    }   

    // Fonction permettant d'afficher le formulaire de création des utilisateurs
    public function create(){

        // Récupérer tous les rôles
        $allRoles = Role::all();

    	return view('users/create', compact('allRoles'));
    }

    // Fonction permettant d'enregistrer un utilisateur
    public function store(StoreUserRequest $request){
    	$user = new User();

    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $pass = $request->input('password');

        $hashPassword = Hash::make($pass);

        $user->password = $hashPassword;

        $user->save();

        $user->assignRole($request->input('role'));

    	return redirect()->route('users')->with('info', 'L\'utilisateur a bien été créé');
    }

    // Fonction permettant d'afficher un utilisateur
    public function show(User $user){
        return view('users/show', compact('user'));
    }

    /* Fonction permettant d'afficher le formulaire de modificatin des utilisateurs
    public function edit(User $user)
    {
        return view('users.edit', compact('user')); 
    }

    // Fonction permettant de modifier un utilisateur
    public function update(UpdateUserRequest $request, User $user){

    }*/

    // Fonction permettant de déplacer un utilisateur dans la corbeille
    public function destroy(User $user) 
    {
        $user->delete();
        return back()->with('info', 'L\'utilisateur a bien été déplacé dans la corbeille.');
    }

    // Fonction permettant de supprimer définitivement un utilisateur
    public function forceDestroy($id)
    {
        User::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'L\'utilisateur a bien été supprimé définitivement dans la base de données.');
    }

    // Fonction permettant de restaurer un utilisateur
    public function restore($id)
    {
        User::withTrashed()->whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'L\'utilisateur a bien été restauré.');
    }

    // Formulaire permettant à un user de choisir son rôle et ses moyens de paiement
    public function chooseReceivePaymentMethod(){
        $paymentMethod = Auth::user()->payment_method_choose;
        return view('payments.choose-payment-method', compact('paymentMethod'));
    }

    public function storePaypalReceivePaymentMethod(Request $request){
        
        $this->validate($request, [
            'paypal_email' => 'bail|required|string|email|max:255|unique:users',
        ]);
        
        
        $paypal_email = $request->input('paypal_email');
        $model_id = $request->input('model_id');

        DB::table('users')->where('id', $model_id)->update(['paypal_email' => $paypal_email, 'payment_method_choose' => 1]);

        return redirect('payments/choose-receive-payment-method');
    }
}
