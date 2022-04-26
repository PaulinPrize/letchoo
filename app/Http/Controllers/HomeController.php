<?php

namespace App\Http\Controllers;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PragmaRX\Countries\Package\Countries;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /*
    public function index(){       
    	return view('welcome');
    }
    */

    public function pays(){
        $countries = new Countries();
        // Récupérer tous les pays
        $allCountries = $countries->all()->pluck('name.common')->toArray();
        // Récupérer la colonne type_of_cuisine dans la table invitations
        $invit = DB::table('invitations')
        ->where('active', '=', 1)
        ->where('complete', '=', 0)
        ->distinct()->get(['type_of_cuisine']);
        return view('welcome', compact('allCountries', 'invit'));
    }

    public function villes($cityName){
        $countries = new Countries();
        
        $villes = $countries->where('name.common', $cityName)
        ->first()
        ->hydrate('cities')
        ->cities
        ->sortBy('name')     
        ->pluck('name');
        
        return response()->json([
            'villes' => $villes,
        ]);
    }

    public function searchData(Request $request){
            
        $country = $request->country;
        $city = $request->city;
        $type_of_cuisine = $request->type_of_cuisine;

        $invitatio = DB::select("select u.name, u.profile_photo_path, i.id, i.menu, i.description, i.image, i.type_of_cuisine, i.number_of_guests, i.price, i.total, i.currency, i.country, i.city, i.place, i.date, i.active, i.complete, i.user_id, i.direct_payment
            from users u
            INNER JOIN invitations i
            ON i.user_id = u.id 
            where (i.active = '1' && i.complete = '0' && i.country = '$country' && i.city = '$city' && i.type_of_cuisine = '$type_of_cuisine')
            ");

        return response()->json($invitatio);
    }

    public function more(Invitation $invitation){
    	return view('more', compact('invitation')); 
    }

    public function dashboard(){
        return view('dashboard');
    }
}
