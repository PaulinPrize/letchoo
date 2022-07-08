<?php

namespace App\Http\Controllers;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PragmaRX\Countries\Package\Countries;
<<<<<<< HEAD
use App\Models\Pays;
=======
use App\Models\{ Ville, Pays };
use Stevebauman\Location\Facades\Location;
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

<<<<<<< HEAD
    public function pays(){
=======
    public function pays(Request $request){
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4

        // Récupérer tous les pays
        $countries = Pays::all();

<<<<<<< HEAD
=======
        //get user location
        //$ip = $request->ip(); oui
        
        $ip = '162.159.24.227'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
        $user_country = Pays::where('nom', $currentUserInfo->countryName)->first();
        //get cities belong to country user
        $user_cities = Ville::where('pays_id', $user_country->id)
            ->limit(8)
            ->select('id', 'nom')
            ->get();

>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        // Récupérer la colonne type_of_cuisine dans la table invitations
        $invit = DB::table('invitations')
        ->where('active', '=', 1)
        ->where('complete', '=', 0)
        ->distinct()->get(['type_of_cuisine']);
        
<<<<<<< HEAD
        return view('welcome', compact('countries', 'invit'));
=======
        return view('welcome', compact('countries', 'invit', 'user_cities'));
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
    }

    public function villes($countryName){
        $villes;

        $pays = Pays::with('villes')->where('nom', $countryName)->get();

        foreach($pays as $p){
            $villes = $p->villes->pluck('nom');
        }
        
        return response()->json([
            'villes' => $villes,
        ]);
    }

    public function searchData(Request $request){
            
<<<<<<< HEAD
        $country = $request->country;
        $city = $request->city;
        $type_of_cuisine = $request->type_of_cuisine;

        $invitatio = DB::select("select u.name, u.profile_photo_path, i.id, i.menu, i.description, i.image, i.type_of_cuisine, i.number_of_guests, i.price, i.amountToBePaidByGuest, i.currency, i.country, i.city, i.place, i.date, i.active, i.complete, i.user_id, i.direct_payment
=======
        ///$country = $request->country;
        $city = $request->city;
        //$type_of_cuisine = $request->type_of_cuisine;

       /*  $invitatio = DB::select("select u.name, u.profile_photo_path, i.id, i.menu, i.description, i.image, i.type_of_cuisine, i.number_of_guests, i.price, i.amountToBePaidByGuest, i.currency, i.country, i.city, i.place, i.date, i.active, i.complete, i.user_id, i.direct_payment
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
            from users u
            INNER JOIN invitations i
            ON i.user_id = u.id 
            where (i.active = '1' && i.complete = '0' && i.country = '$country' && i.city = '$city' && i.type_of_cuisine = '$type_of_cuisine')
<<<<<<< HEAD
            ");
=======
            "); */

            $invitatio = DB::select("select u.name, u.profile_photo_path, i.id, i.menu, i.description, i.image, i.type_of_cuisine, i.number_of_guests, i.price, i.amountToBePaidByGuest, i.currency, i.country, i.city, i.place, i.date, i.active, i.complete, i.user_id, i.direct_payment
                from users u
                INNER JOIN invitations i
                ON i.user_id = u.id 
                where (i.active = '1' && i.complete = '0' && i.city = '$city')"
            );
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4

        return response()->json($invitatio);
    }

    public function more(Invitation $invitation){
    	return view('more', compact('invitation')); 
    }

    public function dashboard(){
        return view('dashboard');
    }
}
