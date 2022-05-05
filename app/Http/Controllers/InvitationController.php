<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use Response;
use App\Models\{ User,Invitation, Transaction, Order, UserInvitation, Coupon, Discount };
use Illuminate\Support\Facades\Auth;
use DB;
use PragmaRX\Countries\Package\Countries;

class InvitationController extends Controller
{
    // Fonction permettant d'afficher toutes les invitations
    public function index()
    {
    	$countInvitations = Invitation::count();
        $widget = [
        	'invitations' => $countInvitations
        ];

        $invitations = Invitation::paginate(5);		

    	return view('invitations/index', compact('invitations','widget')); 
    }

    // Changer le statut d'une invitation (Activer ou pas) action réservée à l'admin
    public function changeInvitationStatus(Request $request){
    	$invitation = Invitation::find($request->invitation_id);
    	$invitation->active = $request->active;
    	$invitation->save();

    	return response()->json(['success'=>'Status ddd']);
    }

    // Cette fonction permet de remplir les champs country, city et type_of_cuisine du formulaire
    public function showAllActiveInvitations() {

        $countries = new Countries();

        // Récupérer tous les pays
        $allCountries = $countries->all()->pluck('name.common')->toArray();

        // Récupérer toutes la colonne type_of_cuisine dans la table invitations
        $invit = DB::table('invitations')
        ->where('active', '=', 1)
        ->where('complete', '=', 0)
        ->distinct()->get(['type_of_cuisine']);

        return view('invitations.all-actives-invitations', compact('allCountries', 'invit'));
    }

    public function getData(Request $request){
            
        $country = $request->country;
        $city = $request->city;
        $type_of_cuisine = $request->type_of_cuisine;
        /*
        $invitatio = DB::select("select u.name, u.profile_photo_path, i.id, i.menu, i.description, i.image, i.type_of_cuisine, i.number_of_guests, i.price, i.currency, i.country, i.city, i.place, i.date, i.active, i.complete, i.user_id
            from users u
            INNER JOIN invitations i
            ON i.user_id = u.id 
            where (i.active = '1' && i.complete = '0' && i.country = '$country' && i.city = '$city' && i.type_of_cuisine = '$type_of_cuisine')
            ");
*/
        $invitatio = DB::table('users')
                    ->join('invitations', 'users.id', '=', 'invitations.user_id')
                    ->select('users.name', 'users.profile_photo_path', 'invitations.id', 'invitations.menu', 'invitations.description', 'invitations.image', 'invitations.type_of_cuisine', 'invitations.number_of_guests', 'invitations.price', 'invitations.currency', 'invitations.total','invitations.country', 'invitations.city', 'invitations.place', 'invitations.date', 'invitations.active', 'invitations.complete', 'invitations.user_id')
                    ->where('invitations.active', '=', 1)
                    ->where('invitations.complete', '=', 0)
                    ->where('invitations.country', '=', $country)
                    ->where('invitations.city', '=', $city)
                    ->where('invitations.type_of_cuisine', '=', $type_of_cuisine)
                    ->get();

        return response()->json($invitatio);
    }

    // Fonction permettant d'afficher le formulaire de création des invitations
    public function create()
    {       
        $countries = new Countries();

        // Récupérer tous les pays
        $allCountries = $countries->all()->pluck('name.common')->toArray(); 

        // Récupérer toutes les régions d'un pays
        $a = $countries->where('name.common', 'Cameroon')->first()->hydrateStates()->states->pluck('name')->toArray();

        // Récupérer toutes les villes d'un pays
        $b = $countries->where('name.common', 'Cameroon')
	    ->first()
	    ->hydrate('cities')
	    ->cities
	    ->sortBy('name')     
	    ->pluck('name'); 

	    // Récupérer la devise d'un pays
	    $d = $countries->where('name.common', 'Cameroon')->first()->currencies[0];
        
        // Récupérer la TVA d'un pays
        $c = $countries->where('name.common','Belgium')->first()->extra->vat_rates->standard;

        $user =  Auth::user()->id;
        return view('invitations.create', compact('user', 'allCountries'));
    }

    public function cities($cityName){
        $countries = new Countries();
        
        $villes = $countries->where('name.common', $cityName)
        ->first()
        ->hydrate('cities')
        ->cities
        ->sortBy('name')     
        ->pluck('name');

        $currency = $countries->where('name.common', $cityName)->first()->currencies[0];

        //$tax = $countries->where('name.common', $cityName)->first()->extra->vat_rates->standard;
        
        return response()->json([
            'villes' => $villes,
            'currency' => $currency,
            //'tax' => $tax
        ]);
    }

    // Fonction permettant d'enregistrer une invitation
    public function store(CreateInvitationRequest $request)
    {
        $invitation = new Invitation();

        $invitation->menu = $request->input('menu');
        $invitation->type_of_cuisine = $request->input('type_of_cuisine');
        $invitation->description = $request->input('description');
        $invitation->country = $request->input('country');
        $invitation->city = $request->input('city');
        $invitation->currency = $request->input('currency');
        // Récupérer la tva fixée
        $fixedTax = $request->input('tax');
        // Enregistrer la taxe fixée dans la BD
        $invitation->tax = $fixedTax;
        $invitation->place = $request->input('place');
        $invitation->postal_code = $request->input('postal_code');
        // Récupérer le champ date
        $maDate = $request->input('date');
        // Convertir la date 
        // $correctionDate = date("Y-m-d H:i:s", strtotime($maDate));
        $correctionDate = date("Y-m-d", strtotime($maDate));
        // Enregistrer la date convertie dans la BD
        $invitation->date = $correctionDate;
        $monHeure = $request->input('heure');
        $invitation->heure = date("H:i", strtotime($monHeure));
        // Récupérer le prix fixé
        $fixedPrice = $request->input('price');
        // Enregistrer le prix fixé dans la BD
        $invitation->price = $fixedPrice;
        // Récupérer le montant total avec la tva et autres frais
        $totalAmount = $fixedPrice+((($fixedPrice*$fixedTax)/100)+(($fixedPrice*15)/100));
        // Montant à remettre à l'hôte
        $income = ($fixedPrice-($fixedPrice*(15/100)));
        $invitation->income = $income;
        $invitation->total = $totalAmount;
        $invitation->number_of_guests = $request->input('number_of_guests');
        // Récupérer le champ image
        $image = $request->file('image');
        // Générer un identifiant unique représentant le nom de cette image
        $fileName = uniqid().'.'.$image->extension();
        // Déplacer l'image dans l'emplacement
        $image->move(storage_path('app/public/plate-photos/'), $fileName);
        // Enregistrer le nom de l'image généré dans la bd
    	$invitation->image = $fileName;	
        $invitation->direct_payment = $request->input('direct_payment');
        // Récupérer l'id de l'utilisateur qui crée l'invitation
    	$invitation->user_id = $request->input('user_id');
        $invitation->save();

        return redirect()->route('invitation.my-tables')->with('info', 'Invitation saved successfully');    
    }

    // Fonction permettant d'afficher une invitation
    public function show(Invitation $invitation){
        return view('invitations/show', compact('invitation'));
    }

    // Fonction permettant d'afficher le formulaire de modification des invitations
    public function edit(Invitation $invitation){
        $countries = new Countries();
        $allCountries = $countries->all()->pluck('name.common')->toArray();
    	$user =  Auth::user()->id;
    	return view('invitations.edit', compact('invitation', 'user', 'allCountries'));
    }

    // Function permettant de modifier une invitation
    public function update(UpdateInvitationRequest $request, Invitation $invitation){
    	$invitation->update($request->all());
		return redirect()->route('invitation.my-invitations')->with('info', 'Invitation updated successfully.');
    }

    // Fonction permettant de supprimer définitivement une invitation
    public function destroy(Invitation $invitation) 
    {
        $invitation->delete();
        /*return redirect(route('invitations.my-invitations')->with('info', 'L\'utilisateur a bien été déplacé dans la corbeille.'));*/

        return back()->with('info', 'The invitation has been permanently deleted.');
    }

    // Fonction permettant d'afficher les invitations créées par un utilisateur (host)
    public function myTables(){
        $user =  Auth::user()->id;
        $invitations =DB::table('invitations')
        ->select('id', 'menu', 'type_of_cuisine', 'number_of_guests', 'price', 'currency', 'date', 'heure', 'active', 'complete')
        ->where('user_id', $user)
        ->paginate(4);
        
        return view('invitations.my-invitations', compact('user', 'invitations'));
    }

    // Fermer une invitation lorsqu'elle est considérée comme complete (réservée à l'hôte)
    public function closeInvitation(Request $request) {
        
        $invitation = Invitation::find($request->invitation_id);
        if(!$invitation->complete) return;

        DB::beginTransaction();

        try {
          
            // get coupon value
             $coupon = Coupon::orderBy('id', 'ASC')->first();

            // retrieve users who are subscribed to this invitation
            $sum = 0;
            foreach($invitation->transactions as $transaction) {

                $order = Order::where([
                    ['transaction_id', $transaction->id],
                    ['status', config('constants.options.operation_completed')]
                ])->first();

                if(!$order) return ;
                $user = User::findOrFail($transaction->user->id);

                if($user) {
                    $discount_value = (($invitation->total * 100) / $coupon->guest_amount);
                    $user->increment("discount", $discount_value);
                    if($user->discount >= 100) {
                        $user->update(["discount" => 0]);
                        Discount::create([
                            "user_id" => $user->id,
                            "order_id" => $order->id,
                            "state" => false,
                        ]);
                    }
                } 

                $sum .= $sum + $order->amount;
               
            }
            
            // get owner invitation
            $owner = User::where('id', $invitation->user_id)->first();

            // update owner discount 
            $owner_discount = (($sum * 100) / $coupon->host_amount);
            $owner->increment("discount", $owner_discount);
            if($owner->discount >= 100) {
                $owner->update(["discount" => 0]);
                Discount::create([
                    "user_id" => $owner->id,
                    "order_id" => $order->id,
                    "state" => false,
                ]);
            }

            // update complete value to true
            $invitation->complete = $request->complete;
            $invitation->save();

            DB::commit();

        } catch(\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        } 
       


    }

    // Fonction permettant à un utilisateur (guest) de souscrire à une invitation en attendant approbation
    public function subscribe(Invitation $invitation) 
    {
        $found_user_invitation = UserInvitation::where([
                ['invitation_id', $invitation->id],
                ['user_id', Auth::user()->id],
        ])->first();

        if($found_user_invitation) $found_user_invitation = true;
        else $found_user_invitation = false;

        return view('invitations/subscribe', compact('invitation', 'found_user_invitation'));
    }

    // Fonction permettant à un utilisateur (guest) de valider sa souscription
    public function validation(Request $request) {
        
        $userInvitation = new UserInvitation();

        $userInvitation->user_id = $request->input('user_id');
        $userInvitation->subscriber_name = $request->input('subscriber_name');
        $userInvitation->invitation_id = $request->input('invitation_id'); 
        $userInvitation->menu = $request->input('menu');
        $userInvitation->owner_id = $request->input('owner_id');
        $userInvitation->amount = $request->input('amount');
        $userInvitation->currency = $request->input('currency');

        $userInvitation->save();

        return redirect()->route('invitation.my-invitations')->with('info', 'Well done');
    }

    // Fonction permettant à un utilisateur guest de payer directement
    public function directPayment(){
        return view('invitation');
    }

    // Fonction permettant d'afficher les souscriptions de l'utilisateur (guest)
    public function myInvitations() {
        
        $user =  Auth::user()->id;
        
        $a = DB::select("select i.menu, i.type_of_cuisine, i.total, i.id, i.price, i.tax, i.currency, i.date, i.complete, iu.id, iu.activeUser, iu.invoice_paid, iu.created_at, iu.invitation_id
        	from invitations i
        	INNER JOIN invitation_user iu
        	ON iu.invitation_id = i.id
        	where iu.user_id = '$user' ");

        return view('invitations.my-subscriptions', compact('a'));
    }

    public function myInvitationsShow($iuID, $amount, $currency){
        return view('payments/payWithPaypal', compact('iuID', 'amount', 'currency'));
    }

    /*
     * Fonction permettant à un utilisateur (Host) d'afficher tous les utilisateurs (guests) 
     * Ayant souscrit à une invitation
    */ 
    public function invitationSubscribers($id){
        $invitation = Invitation::find($id);
        $invitationID = $invitation->id;
        /*
        $allSubscribers = DB::select("select u.profile_photo_path, u.name, u.first_name, u.telephone, u.email, iu.id, iu.invitation_id, iu.activeUser, iu.invoice_paid, iu.created_at, iu.invitation_id  
            from users u
            INNER JOIN invitation_user iu
            ON iu.user_id = u.id 
            where iu.invitation_id = '$invitationID' ");
        */
        return view('invitations.all-subscribers', compact('allSubscribers', 'invitation'));
    }

    // Fonction permettant à un hôte d'accepter un guest
    public function acceptGuest(Request $request){
        $invitation = UserInvitation::find($request->id);
        $invitation->activeUser = $request->activeUser;
        $invitation->save();
    }

    //Leave a bonus 
    public function bonus(Invitation $invitation) {
        return view('invitations.bonus', compact('invitation'));
    }
}
