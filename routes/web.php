<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
https://letchoo.com/linkstorage
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
*/

Route::get('handle-payment', 'PaymentController@handlePayment')->name('make.payment');
Route::get('cancel-payment', 'PaymentController@paymentCancel')->name('cancel.payment');
Route::get('payment-success', 'PaymentController@paymentSuccess')->name('success.payment');

// Route permettant de rediriger vers le formulaire de connexion Google
Route::get('auth/google', '\App\Http\Controllers\SocialMediaController@redirectToGoogle');
Route::get('auth/google/callback', '\App\Http\Controllers\SocialMediaController@googleSignin');

// Route permettant de rediriger vers le formulaire de connexion Facebook
Route::get('auth/facebook', '\App\Http\Controllers\SocialMediaController@redirectToFacebook');
Route::get('auth/facebook/callback', '\App\Http\Controllers\SocialMediaController@facebookSignin');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', '\App\Http\Controllers\HomeController@dashboard')->name('dashboard');

// Route affichant la page d'accueil avec les invitations actives
Route::get('/', '\App\Http\Controllers\HomeController@pays')->name('home');
// Afficher les villes des pays dans le formualire de recherche des invitations (à l'accueil)
Route::get('villes/{cityName}', '\App\Http\Controllers\HomeController@villes')->name('villes');
Route::post('searchData', '\App\Http\Controllers\HomeController@searchData');

// Route permettant d'afficher les détails d'une invitation
Route::get('invitation/more/{invitation}', '\App\Http\Controllers\HomeController@more')->name('invitation.more');

Route::group(['middleware' => 'auth'], function () {
	/* 1- Les routes pour la gestion des utilisateurs */

	// Lister les utilisateurs
	Route::get('users', '\App\Http\Controllers\UserController@index')->name('users');

	// Formulaire de création des utilisateurs
	Route::get('user/create', '\App\Http\Controllers\UserController@create')->name('user.create');

	// Enregistrer un utilisateur
	Route::post('user/store','\App\Http\Controllers\UserController@store')->name('user.store');

	// Afficher un utilisateur
	Route::get('user/show/{user}','\App\Http\Controllers\UserController@show')->name('user.show');

	/* Formulaire de modification
	Route::get('user/{user}/edit','\App\Http\Controllers\UserController@edit')->name('user.edit');*/
	/* Modifier un utilisateur
	Route::put('user/{user}','\App\Http\Controllers\UserController@update')->name('user.update');*/

	// Mettre un utilisateur dans la corbeille
	Route::delete('user/force/{user}', '\App\Http\Controllers\UserController@forceDestroy')->name('user.force.destroy');

	// Restaurer un utilisateur supprimé
	Route::put('user/restore/{user}', '\App\Http\Controllers\UserController@restore')->name('user.restore');

	// Supprimer définitivement un utilisateur
	Route::delete('user/destroy/{user}','\App\Http\Controllers\UserController@destroy')->name('user.destroy');

	// Afficher le formulaire permettant à un user de choisir son rôle et de définir ses moyens de paiement
	Route::get('payments/choose-receive-payment-method', '\App\Http\Controllers\UserController@chooseReceivePaymentMethod')->name('payments.choose-receive-payment-method');
	
	// Enregistrer le moyen de réception des paiments 
	Route::post('payment/store-paypal-receive-payment-method', '\App\Http\Controllers\UserController@storePaypalReceivePaymentMethod')->name('payment.store-paypal-receive-payment-method');

	/* 2- Contrôleur de ressources pour les routes pour la gestion des rôles */
	Route::resource('roles', App\Http\Controllers\RoleController::class);

	/* 3- Contrôleur de ressources pour les routes pour la gestion des permissions */
	Route::resource('permissions', App\Http\Controllers\PermissionController::class);

	/* 4- Les routes pour la gestion des invitations */

	// Lister les invitations
	Route::get('invitations', '\App\Http\Controllers\InvitationController@index')->name('invitations');

	// Changer le statut d'une invitation (Activer ou pas), action effectuée par l'admin
	Route::get('invitation/changeStatus', '\App\Http\Controllers\InvitationController@changeInvitationStatus')->name('invitation.changeStatus');

	//Formulaire de création des invitations
	Route::get('invitation/create', '\App\Http\Controllers\InvitationController@create')->name('invitation.create');

	// Afficher les villes des pays dans le formualire de création des invitations
	Route::get('cities/{cityName}', '\App\Http\Controllers\InvitationController@cities')->name('cities');

	// Enregistrer une invitation
	Route::post('invitation/store','\App\Http\Controllers\InvitationController@store')->name('invitation.store');

	// Afficher une invitation
	Route::get('invitation/show/{invitation}','\App\Http\Controllers\InvitationController@show')->name('invitation.show');

	// Formulaire de modification des invitations
	Route::get('invitation/{invitation}/edit','\App\Http\Controllers\InvitationController@edit')->name('invitation.edit');

	// Modifier une invitation
	Route::put('invitation/{invitation}','\App\Http\Controllers\InvitationController@update')->name('invitation.update');

	// Supprimer définitivement une invitation
	Route::delete('invitation/destroy/{invitation}','\App\Http\Controllers\InvitationController@destroy')->name('invitation.destroy');

	// Afficher la liste des invitations actives et non fermées à un utilisateur
	Route::get('invitations/active', '\App\Http\Controllers\InvitationController@showAllActiveInvitations')->name('invitations.active');
	// 
	Route::post('getData', '\App\Http\Controllers\InvitationController@getData');

	// Afficher les invitations crées par un utilisateur (host)
	Route::get('invitation/my-tables', '\App\Http\Controllers\InvitationController@myTables')->name('invitation.my-tables');

	// Route permettant à un hôte de fermer une invitation lorsqu'il la considère comme complete
	Route::get('invitation/close', '\App\Http\Controllers\InvitationController@closeInvitation')->name('invitation.close');

	// Donner la possibilité à un utilisateur (guest) de souscrire à une invitation
	Route::get('invitation/subscribe/{invitation}', '\App\Http\Controllers\InvitationController@subscribe')->name('invitation.subscribe');

	// Donner la possibilité à un utilisateur (guest) de valider sa souscription
	Route::post('invitation/validation', '\App\Http\Controllers\InvitationController@validation')->name('invitation.validation');

	// Donner la possibilité à un utilisateur guest de payer directement 
	Route::get('invitation/directPayment', '\App\Http\Controllers\InvitationController@directPayment')->name('invitation.directPayment');

	// Route permettant à un hôte d'autoriser un invité à participer 
	Route::get('invitation/accept', '\App\Http\Controllers\InvitationController@acceptGuest')->name('invitation.accept');

	// Donner la possibilité à un utilisateur d'afficher ses souscriptions
	Route::get('invitation/my-invitations', '\App\Http\Controllers\InvitationController@myInvitations')->name('invitation.my-invitations');
	
	// Afficher le formulaire de paiement PAYPAL pour une souscription
	Route::get('invitation/my-invitations/{iuID}/{amount}/{currency}', '\App\Http\Controllers\InvitationController@myInvitationsShow')->name('invitation.my-invitations-show');

	// Payer une souscription en utilisant PAYPAL
	Route::post('invitation/paypal-payment', '\App\Http\Controllers\PaymentController@processPaypalPayment')->name('invitation.paypal-payment');

	// Afficher les guets ayant souscrits à l'invitation d'un host
	Route::get('invitation/invitation-subscribers/{id}', '\App\Http\Controllers\InvitationController@invitationSubscribers')->name('invitation.subscribers');

	// Afficher tous les paiements
	Route::get('payments', '\App\Http\Controllers\PaymentController@index')->name('payments');

	// Afficher à un utilisateur la liste de ses paiements
	Route::get('payments/my-payments', '\App\Http\Controllers\PaymentController@myPayments')->name('payments.my-payments');

	// Afficher les revenus d'un utilisateur
	Route::get('payments/my-income', '\App\Http\Controllers\PaymentController@myIncome')->name('payments.my-income');

	// Define discount amounts
	Route::get('discounts/show-form', '\App\Http\Controllers\DiscountController@show_form')->name('discounts.show-form');
	Route::post('discounts/manage-amount', '\App\Http\Controllers\DiscountController@manage_amount')->name('discounts.manage-amount');

});

Route::get('test', function() {
	// return config('constants.options.completed');
});
