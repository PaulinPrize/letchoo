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
// Routes de gestion de la langue
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// Route permettant de rediriger vers le formulaire de connexion Google
Route::get('auth/google', '\App\Http\Controllers\SocialMediaController@redirectToGoogle');
Route::get('auth/google/callback', '\App\Http\Controllers\SocialMediaController@googleSignin');

// Route permettant de rediriger vers le formulaire de connexion Facebook
Route::get('auth/facebook', '\App\Http\Controllers\SocialMediaController@redirectToFacebook');
Route::get('auth/facebook/callback', '\App\Http\Controllers\SocialMediaController@facebookSignin');

// Route affichant le tableau de bord
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', '\App\Http\Controllers\HomeController@dashboard')->name('dashboard');

// Route affichant la page d'accueil
Route::get('/', '\App\Http\Controllers\HomeController@pays')->name('home');
// Afficher les villes des pays dans le formualire de recherche des invitations (à l'accueil)
Route::get('villes/{countryName}', '\App\Http\Controllers\HomeController@villes')->name('villes');
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

	// Lister les invitations à l'admin
	Route::get('invitations', '\App\Http\Controllers\InvitationController@index')->name('invitations');

	//Formulaire de création des invitations
	Route::get('invitation/create', '\App\Http\Controllers\InvitationController@create')->name('invitation.create');

	Route::get('country/{name}', '\App\Http\Controllers\InvitationController@country')->name('country');

	// Enregistrer une invitation
	Route::post('invitation/store','\App\Http\Controllers\InvitationController@store')->name('invitation.store');

	// Afficher une invitation
	Route::get('invitation/show/{invitation}','\App\Http\Controllers\InvitationController@show')->name('invitation.show');

	// Formulaire de modification des invitations
	Route::get('invitation/{invitation}/edit','\App\Http\Controllers\InvitationController@edit')->name('invitation.edit');

	// Modifier une invitation
	Route::put('invitation/{id}','\App\Http\Controllers\InvitationController@update')->name('invitation.update');

	// Supprimer définitivement une invitation
	Route::delete('invitation/destroy/{invitation}','\App\Http\Controllers\InvitationController@destroy')->name('invitation.destroy');

	// Valider une invitation (l'activer pour qu'elle soit visible) après sa création
	Route::get('invitation/changeStatus', '\App\Http\Controllers\InvitationController@changeInvitationStatus')->name('invitation.changeStatus');

	// Fermer une invitation 
	Route::get('invitation/close', '\App\Http\Controllers\InvitationController@closeInvitation')->name('invitation.close');

	// Afficher la liste des invitations actives et non fermées à un utilisateur
	Route::get('invitations/active', '\App\Http\Controllers\InvitationController@showAllActiveInvitations')->name('invitations.active');

	// Rechercher une invitation
	Route::post('getData', '\App\Http\Controllers\InvitationController@getData');

	// Afficher les invitations crées par un utilisateur (host)
	Route::get('invitation/my-tables', '\App\Http\Controllers\InvitationController@myTables')->name('invitation.my-tables');
	
	// Lancer sa souscription (guest)
	Route::get('invitation/subscribe/{invitation}', '\App\Http\Controllers\InvitationController@subscribe')->name('invitation.subscribe');

	// Terminer sa souscription (guest)
	Route::post('invitation/validation', '\App\Http\Controllers\InvitationController@validation')->name('invitation.validation');
	
	// Afficher tous les guests ayant souscrit à l'invitation d'un host
	Route::get('invitation/invitation-subscribers/{id}', '\App\Http\Controllers\InvitationController@invitationSubscribers')->name('invitation.subscribers');	

	// Afficher ses souscriptions
	Route::get('invitation/my-invitations', '\App\Http\Controllers\InvitationController@myInvitations')->name('invitation.my-invitations');	

	// Accepter une souscription 
	Route::get('invitation/accept', '\App\Http\Controllers\InvitationController@acceptGuest')->name('invitation.accept');

	//Laisser un pourboire à l'hôte
	Route::get('invitation/{invitation}/bonus', '\App\Http\Controllers\InvitationController@bonus')->name('invitation.bonus');

	/* 5- Les routes pour la gestion des paiements */

	// Afficher toutes les tables qui ont reçu des paiements à l'admin
	Route::get('payments', '\App\Http\Controllers\PaymentController@index')->name('payments');
	// Afficher les détails des paiements d'une table
	Route::get('payment-detail/{id}', '\App\Http\Controllers\PaymentController@paymentDetail')->name('payment-detail'); 

	// Afficher les revenus d'un utilisateur par table
	Route::get('payments/my-income', '\App\Http\Controllers\PaymentController@myIncome')->name('payments.my-income');
	// Afficher les détails des paiements par table
	Route::get('income-detail/{id}', '\App\Http\Controllers\PaymentController@incomeDetail')->name('income-detail'); 

	// Afficher à un utilisateur la liste de ses paiements
	Route::get('payments/my-payments', '\App\Http\Controllers\PaymentController@myPayments')->name('payments.my-payments');


	// Define discount amounts
	Route::get('discounts/show-form', '\App\Http\Controllers\DiscountController@show_form')->name('discounts.show-form');
	Route::post('discounts/manage-amount', '\App\Http\Controllers\DiscountController@manage_amount')->name('discounts.manage-amount');

	/* 6- Les routes pour la gestion des pays */
	Route::resource('countries', App\Http\Controllers\CountryController::class);

	/* 7- Les routes pour la gestion des villes */

	// Lister toutes les villes
	Route::get('villes', '\App\Http\Controllers\CityController@index')->name('villes');

	// Formulaire de création des villes
	Route::get('ville/create', '\App\Http\Controllers\CityController@create')->name('ville.create');

	// Enregistrer une ville
	Route::post('ville/store','\App\Http\Controllers\CityController@store')->name('ville.store');

	// Afficher un utilisateur
	Route::get('ville/show/{ville}','\App\Http\Controllers\CityController@show')->name('ville.show');

	// Formulaire de modification des villes
	Route::get('ville/{ville}/edit','\App\Http\Controllers\CityController@edit')->name('ville.edit');

	// Modifier une ville
	Route::put('ville/{ville}','\App\Http\Controllers\CityController@update')->name('ville.update');

	// Supprimer définitivement une ville
	Route::delete('ville/destroy/{ville}','\App\Http\Controllers\CityController@destroy')->name('ville.destroy');
	
});

<<<<<<< HEAD
=======
Route::get('cities', '\App\Http\Controllers\CityController@get');

>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
