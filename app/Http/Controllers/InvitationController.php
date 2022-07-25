<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use Response;
use App\Models\{ User,Invitation, Transaction, Order, UserInvitation, Coupon, Discount, Pays, Ville };
use Illuminate\Support\Facades\Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Notification;
use App\Notifications\SendEmailNotification;


class InvitationController extends Controller
{
    // Fonction permettant d'afficher toutes les invitations
    public function index()
    {   
        $invitations = Invitation::withCount(['transactions' => function($query){
            $query->where('status', 'COMPLETED')
            ->where('transaction_type', 'Payment');
        }])->paginate(5);                      

        return view('invitations/index', compact('invitations')); 
    }

    // Fonction permettant d'afficher le formulaire de création des invitations
    public function create()
    {       
        // Récupérer tous les pays
        $countries = Pays::all();

        // Tableau contenant la liste des pays, il servira pour le champ type of cuisine
        $pays = array(
            'AFG' => 'Afghanistan',
            'ZAF' => 'Afrique du Sud',
            'ALA' => 'Åland',
            'ALB' => 'Albanie',
            'DZA' => 'Algérie',
            'DEU' => 'Allemagne',
            'AND' => 'Andorre',
            'AGO' => 'Angola',
            'AIA' => 'Anguilla',
            'ATA' => 'Antarctique',
            'ATG' => 'Antigua-et-Barbuda',
            'ANT' => 'Antilles néerlandaises',
            'SAU' => 'Arabie saoudite',
            'ARG' => 'Argentine',
            'ARM' => 'Arménie',
            'ABW' => 'Aruba',
            'AUS' => 'Australie',
            'AUT' => 'Autriche',
            'AZE' => 'Azerbaïdjan',
            'BHS' => 'Bahamas',
            'BHR' => 'Bahreïn',
            'BGD' => 'Bangladesh',
            'BRB' => 'Barbade',
            'BLR' => 'Biélorussie',
            'BEL' => 'Belgique',
            'BLZ' => 'Belize',
            'BEN' => 'Bénin',
            'BMU' => 'Bermudes',
            'BTN' => 'Bhoutan',
            'MMR' => 'Birmanie',
            'BOL' => 'Bolivie',
            'BIH' => 'Bosnie-Herzégovine',
            'BWA' => 'Botswana',
            'BRA' => 'Brésil',
            'BRN' => 'Brunei',
            'BGR' => 'Bulgarie',
            'BFA' => 'Burkina Faso',
            'BDI' => 'Burundi',
            'KHM' => 'Cambodge',
            'CMR' => 'Cameroun',
            'CAN' => 'Canada',
            'CPV' => 'Cap-Vert',
            'CHL' => 'Chili',
            'CHN' => 'Chine',
            'CYP' => 'Chypre',
            'COL' => 'Colombie',
            'COM' => 'Comores',
            'COG' => 'Congo-Brazzaville',
            'COD' => 'Congo-Kinshasa',
            'KOR' => 'Corée du Sud',
            'PRK' => 'Corée du Nord',
            'CRI' => 'Costa Rica',
            'CIV' => 'Côte d\'Ivoire',
            'HRV' => 'Croatie',
            'CUB' => 'Cuba',
            'DNK' => 'Danemark',
            'DJI' => 'Djibouti',
            'DMA' => 'Dominique',
            'EGY' => 'Égypte',
            'ARE' => 'Émirats arabes unis',
            'ECU' => 'Équateur',
            'ERI' => 'Érythrée',
            'ESP' => 'Espagne',
            'EST' => 'Estonie',
            'USA' => 'États-Unis',
            'ETH' => 'Éthiopie',
            'FJI' => 'Fidji',
            'FIN' => 'Finlande',
            'FRA' => 'France',
            'GAB' => 'Gabon',
            'GMB' => 'Gambie',
            'GEO' => 'Géorgie',
            'SGS' => 'Géorgie du Sud-et-les Îles Sandwich du Sud',
            'GHA' => 'Ghana',
            'GIB' => 'Gibraltar',
            'GRC' => 'Grèce',
            'GRD' => 'Grenade',
            'GRL' => 'Groenland',
            'GLP' => 'Guadeloupe',
            'GUM' => 'Guam',
            'GTM' => 'Guatemala',
            'GGY' => 'Guernesey',
            'GIN' => 'Guinée',
            'GNB' => 'Guinée-Bissau',
            'GNQ' => 'Guinée équatoriale',
            'GUY' => 'Guyana',
            'GUF' => 'Guyane',
            'HTI' => 'Haïti',
            'HND' => 'Honduras',
            'HKG' => 'Hong Kong',
            'HUN' => 'Hongrie',
            'BVT' => 'Île Bouvet',
            'CYM' => 'Îles Caïmans',
            'CXR' => 'Île Christmas',
            'CCK' => 'Îles Cocos',
            'COK' => 'Îles Cook',
            'IMN' => 'Île de Man',
            'FRO' => 'Îles Féroé',
            'HMD' => 'Îles Heard-et-MacDonald',
            'FLK' => 'Îles Malouines',
            'MNP' => 'Îles Mariannes du Nord',
            'UMI' => 'Îles mineures éloignées des États-Unis',
            'PCN' => 'Îles Pitcairn',
            'VGB' => 'Îles Vierges britanniques',
            'VIR' => 'Îles Vierges des États-Unis',
            'IND' => 'Inde',
            'IDN' => 'Indonésie',
            'IRN' => 'Iran',
            'IRQ' => 'Irak',
            'IRL' => 'Irlande',
            'ISL' => 'Islande',
            'ISR' => 'Israël',
            'ITA' => 'Italie',
            'JAM' => 'Jamaïque',
            'JPN' => 'Japon',
            'JEY' => 'Jersey',
            'JOR' => 'Jordanie',
            'KAZ' => 'Kazakhstan',
            'KEN' => 'Kenya',
            'KGZ' => 'Kirghizistan',
            'KIR' => 'Kiribati',
            'KWT' => 'Koweït',
            'REU' => 'La Réunion',
            'LAO' => 'Laos',
            'LSO' => 'Lesotho',
            'LVA' => 'Lettonie',
            'LBN' => 'Liban',
            'LBR' => 'Liberia',
            'LBY' => 'Libye',
            'LIE' => 'Liechtenstein',
            'LTU' => 'Lituanie',
            'LUX' => 'Luxembourg',
            'MAC' => 'Macao',
            'MKD' => 'Macédoine',
            'MDG' => 'Madagascar',
            'MYS' => 'Malaisie',
            'MWI' => 'Malawi',
            'MDV' => 'Maldives',
            'MLI' => 'Mali',
            'MLT' => 'Malte',            
            'MAR' => 'Maroc',
            'MHL' => 'Marshall',
            'MTQ' => 'Martinique',
            'MUS' => 'Maurice',
            'MRT' => 'Mauritanie',
            'MYT' => 'Mayotte',
            'MEX' => 'Mexique',
            'FSM' => 'Micronésie',
            'MDA' => 'Moldavie',
            'MCO' => 'Monaco',
            'MNG' => 'Mongolie',
            'MNE' => 'Monténégro',
            'MSR' => 'Montserrat',
            'MOZ' => 'Mozambique',            
            'NAM' => 'Namibie',
            'NRU' => 'Nauru',
            'NPL' => 'Népal',
            'NIC' => 'Nicaragua',
            'NER' => 'Niger',
            'NGA' => 'Nigeria',
            'NIU' => 'Niue',
            'NFK' => 'Norfolk',
            'NOR' => 'Norvège',
            'NCL' => 'Nouvelle-Calédonie',
            'NZL' => 'Nouvelle-Zélande',
            'OMN' => 'Oman',
            'UGA' => 'Ouganda',
            'UZB' => 'Ouzbékistan',
            'PAK' => 'Pakistan',
            'PLW' => 'Palaos',
            'PSE' => 'Palestine',
            'PAN' => 'Panamá',
            'PNG' => 'Papouasie-Nouvelle-Guinée',
            'PRY' => 'Paraguay',
            'NLD' => 'Pays-Bas',
            'PER' => 'Pérou',
            'PHL' => 'Philippines',            
            'POL' => 'Pologne',
            'PYF' => 'Polynésie française',
            'PRI' => 'Porto Rico',
            'PRT' => 'Portugal',
            'QAT' => 'Qatar',
            'CAF' => 'République centrafricaine',
            'DOM' => 'République dominicaine',
            'CZE' => 'République tchèque',
            'ROU' => 'Roumanie',
            'UK' => 'Royaume-Uni',
            'RUS' => 'Russie',
            'RWA' => 'Rwanda',
            'ESH' => 'Sahara occidental',
            'BLM' => 'Saint-Barthélemy',
            'KNA' => 'Saint-Christophe-et-Niévès',
            'SMR' => 'Saint-Marin',
            'MAF' => 'Saint-Martin',
            'SPM' => 'Saint-Pierre-et-Miquelon',
            'VCT' => 'Saint-Vincent-et-les Grenadines',
            'SHN' => 'Sainte-Hélène',
            'LCA' => 'Sainte-Lucie',
            'SLB' => 'Salomon',
            'SLV' => 'Salvador',
            'WSM' => 'Samoa',
            'ASM' => 'Samoa américaines',
            'STP' => 'Sao Tomé-et-Principe',
            'SEN' => 'Sénégal',
            'SRB' => 'Serbie',
            'SYC' => 'Seychelles',
            'SLE' => 'Sierra Leone',
            'SGP' => 'Singapour',
            'SVK' => 'Slovaquie',
            'SVN' => 'Slovénie',
            'SOM' => 'Somalie',
            'SDN' => 'Soudan',
            'LKA' => 'Sri Lanka',
            'SWE' => 'Suède',
            'CHE' => 'Suisse',
            'SUR' => 'Suriname',
            'SJM' => 'Svalbard et île Jan Mayen',
            'SWZ' => 'Swaziland',
            'SYR' => 'Syrie',
            'TJK' => 'Tadjikistan',
            'TWN' => 'Taïwan',
            'TZA' => 'Tanzanie',
            'TCD' => 'Tchad',            
            'ATF' => 'Terres australes et antarctiques françaises',
            'IOT' => 'Territoire britannique de l\'océan Indien',
            'THA' => 'Thaïlande',
            'TLS' => 'Timor oriental',
            'TGO' => 'Togo',
            'TKL' => 'Tokelau',
            'TON' => 'Tonga',
            'TTO' => 'Trinité-et-Tobago',
            'TUN' => 'Tunisie',
            'TKM' => 'Turkménistan',
            'TCA' => 'Îles Turques-et-Caïques',
            'TUR' => 'Turquie',
            'TUV' => 'Tuvalu',
            'UKR' => 'Ukraine',
            'URY' => 'Uruguay',
            'VUT' => 'Vanuatu',
            'VAT' => 'Vatican (Saint-Siège)',
            'VEN' => 'Venezuela',
            'VNM' => 'Viêt Nam',
            'WLF' => 'Wallis-et-Futuna',
            'YEM' => 'Yémen',
            'ZMB' => 'Zambie',
            'ZWE' => 'Zimbabwe',
        );

        $user =  Auth::user()->id;
        
        return view('invitations.create', compact('user', 'countries', 'pays'));
    }

    public function country($name){

        $villes;
        $currency;
        $tax;

        $pays = Pays::with('villes')->where('nom', $name)->get();

        foreach($pays as $p){
            $villes = $p->villes->pluck('nom');
        }

        $currency = DB::table('pays')->select('currency')->where('nom', '=', $name)->pluck('currency');

        $tax = DB::table('pays')->select('tax')->where('nom', '=', $name)->pluck('tax');

        return response()->json([
            'villes' => $villes,
            'currency' => $currency,
            'tax' => $tax
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

        // Récupérer le montant total à payer par le guest (prix fixé + tva + 5%)
        $amountToBePaidByGuest = $fixedPrice + ((($fixedPrice*$fixedTax)/100)+(($fixedPrice*5)/100));
        $invitation->amountToBePaidByGuest = $amountToBePaidByGuest;

        // Montant à remettre à l'hôte
        $amountToBePaidToTheHost = ($fixedPrice-($fixedPrice*(15/100)));
        $invitation->amountToBePaidToTheHost = $amountToBePaidToTheHost;
        
        // Revenus tva
        $taxIncome = ($fixedPrice*$fixedTax)/100;
        $invitation->taxIncome = $taxIncome;

        // Nos revenus
        $income = ($fixedPrice*20)/100;
        $invitation->income = $income;
        
        $invitation->number_of_guests = $request->input('number_of_guests');
        // Récupérer le champ image

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            // Générer un identifiant unique représentant le nom de cette image
            $fileName = uniqid().'.'.$image->extension();
            // Déplacer l'image dans l'emplacement
            $image->move(storage_path('app/public/plate-photos/'), $fileName);
            // Enregistrer le nom de l'image généré dans la bd
            $invitation->image = $fileName;
        }
         
        $invitation->direct_payment = $request->input('direct_payment');
        // Récupérer l'id de l'utilisateur qui crée l'invitation
        $invitation->user_id = $request->input('user_id');

        $invitation->save();

        // Récupérer l'email de l'user qui crée l'invitation pour lui envoyer un mail
        $userId = Auth::user()->id;
        $userName = Auth::user()->name;
        $userEmail = User::findOrFail($userId);

        $details = [
            'greeting' => 'Hi ' .$userName. ',',
            'body' => 'Your table has been successfully created. 
            It will be published on the platform after validation.',
            'actiontext' => 'Subscribe this channel'
        ];

        Notification::send($userEmail, new SendEmailNotification($details));

        // Trouver les admins
        $admin = User::find(1);

        $details2 = [
            'greeting' => 'Hi',
            'body' => 'A new table has been created.',
            'actiontext' => 'Subscribe this channel'
        ];

        Notification::send($admin, new SendEmailNotification($details2));

        return redirect()->route('invitation.my-tables')->withInfo(__('messages.Table created successfully'));    
    }

    // Fonction permettant d'afficher une invitation
    public function show(Invitation $invitation){
        return view('invitations/show', compact('invitation'));
    }

    // Fonction permettant d'afficher le formulaire de modification des invitations
    public function edit($id){

        // Récupérer l'invitation
        $invitation = Invitation::findOrFail($id);

        // Récupérer tous les pays
        $countries = Pays::all();

        $user =  Auth::user()->id;

        return view('invitations.edit', compact('invitation', 'user', 'countries'));
    }

    // Function permettant de modifier une invitation
    public function update(UpdateInvitationRequest $request, Invitation $invitation){

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

        // Récupérer le montant total à payer par le guest (prix fixé + tva + 5%)
        $amountToBePaidByGuest = $fixedPrice + ((($fixedPrice*$fixedTax)/100)+(($fixedPrice*5)/100));
        $invitation->amountToBePaidByGuest = $amountToBePaidByGuest;

        // Montant à remettre à l'hôte
        $amountToBePaidToTheHost = ($fixedPrice-($fixedPrice*(15/100)));
        $invitation->amountToBePaidToTheHost = $amountToBePaidToTheHost;
        
        // Revenus tva
        $taxIncome = ($fixedPrice*$fixedTax)/100;
        $invitation->taxIncome = $taxIncome;

        // Nos revenus
        $income = ($fixedPrice*20)/100;
        $invitation->income = $income;
        
        $invitation->number_of_guests = $request->input('number_of_guests');

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            // Générer un identifiant unique représentant le nom de cette image
            $fileName = uniqid().'.'.$image->extension();
            // Déplacer l'image dans l'emplacement
            $image->move(storage_path('app/public/plate-photos/'), $fileName);
            // Enregistrer le nom de l'image généré dans la bd
            $invitation->image = $fileName;
        }
        
        $invitation->direct_payment = $request->input('direct_payment');
        // Récupérer l'id de l'utilisateur qui crée l'invitation
        $invitation->user_id = $request->input('user_id');

        $invitation->update();

        return redirect()->route('invitation.my-tables')->withInformation(__('messages.Table modified successfully'));
    }

    // Fonction permettant de supprimer définitivement une invitation
    public function destroy(Invitation $invitation) 
    {
        $invitation->delete();

        return back()->withInformation(__('The invitation has been permanently deleted'));
    }

    // Valider une invitation (l'activer pour qu'elle soit visible) après sa création
    public function changeInvitationStatus(Request $request){

        $invitation = Invitation::find($request->invitation_id);
        $invitation->active = $request->active;

        $invitation->save();

        // Récupérer l'email de l'user qui crée l'invitation pour lui envoyer un mail
        $userId = $invitation->user_id;
        $userEmail = User::findOrFail($userId);

        $details = [
            'greeting' => 'Hi, ',
            'body' => 'Your table ' . $invitation->menu . ' has been approved.',
            'actiontext' => 'Subscribe this channel'
        ];

        Notification::send($userEmail, new SendEmailNotification($details));

        return response()->json(['success'=>'Status ddd']);

    }

    // Fermer une invitation
    public function closeInvitation(Request $request) {
        
        $invitation = Invitation::find($request->invitation_id);
        //if($invitation->complete) return;

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

    // Fonction permettant d'afficher la liste des invitations actives et non fermées
    public function showAllActiveInvitations(Request $request) {

        $allCountries = Pays::all();

         $user_country = [];
 
         if(str_contains(url('/'), 'localhost') || str_contains(url('/'), '127.0.0.1')) {
 
             $user_country = Pays::where('nom', 'France')->first();
 
         } else {
 
             if($request->ipinfo->country_name) {
                 $user_country = Pays::where('nom', $request->ipinfo->country_name)->first();
             } else {
                 $user_country = Pays::where('nom', 'France')->first();
             }
             
         }
    
        //get cities belong to country user
        $user_cities = Ville::where('pays_id', $user_country->id)
            ->limit(5)
            ->select('id', 'nom')
            ->get();

        // Récupérer toutes la colonne type_of_cuisine dans la table invitations
        $invit = DB::table('invitations')
        ->where('active', '=', 1)
        ->where('complete', '=', 0)
        ->distinct()->get(['type_of_cuisine']);

        return view('invitations.all-actives-invitations', compact('allCountries', 'invit', 'user_cities'));
    }

    // Rechercher une invitation
    public function getData(Request $request){
            
        $country = $request->country;
        $city = $request->city;
        $type_of_cuisine = $request->type_of_cuisine;

        $invitatio = DB::table('users')
            /*
            ->join('invitations', function($join){

                $country = $request->country;
                $city = $request->city;
                $type_of_cuisine = $request->type_of_cuisine;

                $join->on('users.id', '=', 'invitations.user_id')
                ->select('users.*', 'invitations.*')
                ->where('invitations.active', '=', 1)
                ->where('invitations.complete', '=', 0)
                ->where('invitations.country', '=', $country)
                ->where('invitations.city', '=', $city)
                ->where('invitations.type_of_cuisine', '=', $type_of_cuisine);
            })->get();
            */
            ->join('invitations', 'users.id', '=', 'invitations.user_id')
            ->select('users.*', 'invitations.*')
            ->where('invitations.active', '=', 1)
            ->where('invitations.complete', '=', 0)
            ->where('invitations.country', '=', $country)
            ->where('invitations.city', '=', $city)
            ->where('invitations.type_of_cuisine', '=', $type_of_cuisine)
            ->get();

        return response()->json($invitatio);
    }

    // Fonction permettant d'afficher les invitations créées par un utilisateur (host)
    public function myTables(){

        $user =  Auth::user()->id;

        $invitations = Invitation::withCount(['transactions' => function($query){
            $query->where('status', 'COMPLETED')
            ->where('transaction_type', 'Payment');
        }])->where('user_id', $user)->paginate(4);

        if(session('info')){
            Alert::success(session('info'), __('messages.LeTchoo will take 15% of your total turnover for this table'));
        }
                   
        return view('invitations.my-invitations', compact('user', 'invitations'));
    }

    // Lancer sa souscription (guest)
    public function subscribe(Invitation $invitation) 
    {
        $found_user_invitation = UserInvitation::where([
            ['invitation_id', $invitation->id],
            ['user_id', Auth::user()->id],
        ])->first();
        
        if($found_user_invitation) $found_user_invitation = true;
        else $found_user_invitation = false;

        // Récupérer l'identifiant de l'invitation
        $invitationID = $invitation->id;

        // Récupérer l'identifiant de l'utilisateur connecté
        $userID = Auth::user()->id;

        /*
        $testUserPayment = DB::table('transactions')
        ->where('invitation_id', '=', $invitationID)
        ->where('user_id', '=', $userID)
        ->where('transaction_type', '=', 'Payment')
        ->where('status', '=', 'COMPLETED')
        ->get();

        $found_activeUser = UserInvitation::where([
            ['activeUser', 1],
            ['user_id', Auth::user()->id]
        ])->get();

        $size = sizeof($testUserPayment);
        $activeUser = sizeof($found_activeUser);
        */

        // Savoir si un utilisateur a déjà payé sur une table
        $testUserPayment = DB::table('transactions')
        ->where('invitation_id', '=', $invitationID)
        ->where('user_id', '=', $userID)
        ->where('transaction_type', '=', 'Payment')
        ->where('status', '=', 'COMPLETED')
        ->get();

        $size1 = sizeof($testUserPayment);

        return view('invitations/subscribe', compact('invitation', 'size1'));
    }

    // Terminer sa souscription
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

        // Récupérer les informations de l'hôte
        $userHostId = $userInvitation->owner_id;
        $userEmail2 = User::find($userHostId);

        $details2 = [
            'greeting' => 'Hi, ',
            'body' => $userInvitation->subscriber_name . ' would like to be your guest.',
            'actiontext' => 'Subscribe this channel'
        ];

        Notification::send($userEmail2, new SendEmailNotification($details2));

        return redirect()->route('invitation.my-invitations')->withInfo(__('messages.Subscription completed successfully'));
    }

    // Afficher ses souscriptions (guest)
    public function myInvitations() {
        
        $user =  Auth::user()->id;
        
        $a = DB::select("select i.menu, i.type_of_cuisine, i.amountToBePaidByGuest, i.id, i.price, i.tax, i.currency, i.date, i.complete, iu.id, iu.activeUser, iu.created_at, iu.invitation_id
            from invitations i
            INNER JOIN invitation_user iu
            ON iu.invitation_id = i.id
            where iu.user_id = '$user' ");

        if(session('info')){
            Alert::success(session('info'), __('messages.Please wait for host validation'));
        }

        return view('invitations.my-subscriptions', compact('a'));
    }

    // Afficher tous les guests ayant souscrit à l'invitation d'un host
    public function invitationSubscribers($id){
        $invitation = Invitation::find($id);
        $invitationID = $invitation->id;
        
        $allSubscribers = DB::select("select u.profile_photo_path, u.name, u.first_name, u.telephone, u.email, iu.id, iu.invitation_id, iu.activeUser, iu.created_at, iu.invitation_id  
            from users u
            INNER JOIN invitation_user iu
            ON iu.user_id = u.id 
            where iu.invitation_id = '$invitationID' ");
        
        return view('invitations.all-subscribers', compact('allSubscribers', 'invitation'));
    }

    // Accepter une souscription
    public function acceptGuest(Request $request){

        $invitation = UserInvitation::find($request->id);

        $invitation->activeUser = $request->activeUser;

        $invitation->save();

        //$subscriber = User::where('id', $invitation_user->user_id)->get();

        // Récupérer l'email de l'user qui a souscrit à l'invitation pour lui envoyer un mail
        $userId = $invitation->activeUser;
        $userEmail = User::findOrFail($userId);

        $details = [
            'greeting' => 'Hi, ',
            'body' => 'Your subscription has been approved. You can pay to be a guest',
            'actiontext' => 'Subscribe this channel'
        ];

        Notification::send($userEmail, new SendEmailNotification($details));
    }            

    // Laisser un bonus 
    public function bonus(Invitation $invitation) {
        return view('invitations.bonus', compact('invitation'));
    }
}
