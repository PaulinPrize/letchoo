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
<<<<<<< HEAD
=======
use Stevebauman\Location\Facades\Location;
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4

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

<<<<<<< HEAD
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
            'BOL' => 'Bolivie',
            'BIH' => 'Bosnie-Herzégovine',
            'BWA' => 'Botswana',
            'BVT' => 'Île Bouvet',
            'BRA' => 'Brésil',
            'BRN' => 'Brunei',
            'BGR' => 'Bulgarie',
            'BFA' => 'Burkina Faso',
            'BDI' => 'Burundi',
            'CYM' => 'Îles Caïmans',
            'KHM' => 'Cambodge',
            'CMR' => 'Cameroun',
            'CAN' => 'Canada',
            'CPV' => 'Cap-Vert',
            'CAF' => 'République centrafricaine',
            'CHL' => 'Chili',
            'CHN' => 'Chine',
            'CXR' => 'Île Christmas',
            'CYP' => 'Chypre',
            'CCK' => 'Îles Cocos',
            'COL' => 'Colombie',
            'COM' => 'Comores',
            'COG' => 'Congo-Brazzaville',
            'COD' => 'Congo-Kinshasa',
            'COK' => 'Îles Cook',
            'KOR' => 'Corée du Sud',
            'PRK' => 'Corée du Nord',
            'CRI' => 'Costa Rica',
            'CIV' => 'Côte d\'Ivoire',
            'HRV' => 'Croatie',
            'CUB' => 'Cuba',
            'DNK' => 'Danemark',
            'DJI' => 'Djibouti',
            'DOM' => 'République dominicaine',
            'DMA' => 'Dominique',
            'EGY' => 'Égypte',
            'SLV' => 'Salvador',
            'ARE' => 'Émirats arabes unis',
            'ECU' => 'Équateur',
            'ERI' => 'Érythrée',
            'ESP' => 'Espagne',
            'EST' => 'Estonie',
            'USA' => 'États-Unis',
            'ETH' => 'Éthiopie',
            'FLK' => 'Îles Malouines',
            'FRO' => 'Îles Féroé',
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
            'HMD' => 'Îles Heard-et-MacDonald',
            'HND' => 'Honduras',
            'HKG' => 'Hong Kong',
            'HUN' => 'Hongrie',
            'IMN' => 'Île de Man',
            'UMI' => 'Îles mineures éloignées des États-Unis',
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
            'MNP' => 'Îles Mariannes du Nord',
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
            'MMR' => 'Birmanie',
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
            'IOT' => 'Territoire britannique de l\'océan Indien',
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
            'PCN' => 'Îles Pitcairn',
            'POL' => 'Pologne',
            'PYF' => 'Polynésie française',
            'PRI' => 'Porto Rico',
            'PRT' => 'Portugal',
            'QAT' => 'Qatar',
            'REU' => 'La Réunion',
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
            'VAT' => 'Vatican (Saint-Siège)',
            'VCT' => 'Saint-Vincent-et-les Grenadines',
            'SHN' => 'Sainte-Hélène',
            'LCA' => 'Sainte-Lucie',
            'SLB' => 'Salomon',
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
            'CZE' => 'République tchèque',
            'ATF' => 'Terres australes et antarctiques françaises',
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
            'VEN' => 'Venezuela',
            'VNM' => 'Viêt Nam',
            'WLF' => 'Wallis-et-Futuna',
            'YEM' => 'Yémen',
            'ZMB' => 'Zambie',
            'ZWE' => 'Zimbabwe',
        );

        $user =  Auth::user()->id;
        
        return view('invitations.create', compact('user', 'countries', 'pays'));
=======
        $user =  Auth::user()->id;
        
        return view('invitations.create', compact('user', 'countries'));
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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
<<<<<<< HEAD

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            // Générer un identifiant unique représentant le nom de cette image
            $fileName = uniqid().'.'.$image->extension();
            // Déplacer l'image dans l'emplacement
            $image->move(storage_path('app/public/plate-photos/'), $fileName);
            // Enregistrer le nom de l'image généré dans la bd
            $invitation->image = $fileName;
        }
         
=======
        $image = $request->file('image');
        // Générer un identifiant unique représentant le nom de cette image
        $fileName = uniqid().'.'.$image->extension();
        // Déplacer l'image dans l'emplacement
        $image->move(storage_path('app/public/plate-photos/'), $fileName);
        // Enregistrer le nom de l'image généré dans la bd
        $invitation->image = $fileName; 
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        $invitation->direct_payment = $request->input('direct_payment');
        // Récupérer l'id de l'utilisateur qui crée l'invitation
        $invitation->user_id = $request->input('user_id');

        $invitation->save();

<<<<<<< HEAD
        return redirect()->route('invitation.my-tables')->withInfo(__('messages.Table created successfully'));    
=======
        return redirect()->route('invitation.my-tables')->with('info', 'Table créée avec succès.');    
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
    }

    // Fonction permettant d'afficher une invitation
    public function show(Invitation $invitation){
        return view('invitations/show', compact('invitation'));
    }

    // Fonction permettant d'afficher le formulaire de modification des invitations
<<<<<<< HEAD
    public function edit(Invitation $invitation){
        // Récupérer l'invitation $invitation = Invitation::findOrFail($id);
        
        // Récupérer tous les pays
        $countries = Pays::all();

        // Liste des pays à passer au type de cuisine
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
            'BOL' => 'Bolivie',
            'BIH' => 'Bosnie-Herzégovine',
            'BWA' => 'Botswana',
            'BVT' => 'Île Bouvet',
            'BRA' => 'Brésil',
            'BRN' => 'Brunei',
            'BGR' => 'Bulgarie',
            'BFA' => 'Burkina Faso',
            'BDI' => 'Burundi',
            'CYM' => 'Îles Caïmans',
            'KHM' => 'Cambodge',
            'CMR' => 'Cameroun',
            'CAN' => 'Canada',
            'CPV' => 'Cap-Vert',
            'CAF' => 'République centrafricaine',
            'CHL' => 'Chili',
            'CHN' => 'Chine',
            'CXR' => 'Île Christmas',
            'CYP' => 'Chypre',
            'CCK' => 'Îles Cocos',
            'COL' => 'Colombie',
            'COM' => 'Comores',
            'COG' => 'Congo-Brazzaville',
            'COD' => 'Congo-Kinshasa',
            'COK' => 'Îles Cook',
            'KOR' => 'Corée du Sud',
            'PRK' => 'Corée du Nord',
            'CRI' => 'Costa Rica',
            'CIV' => 'Côte d\'Ivoire',
            'HRV' => 'Croatie',
            'CUB' => 'Cuba',
            'DNK' => 'Danemark',
            'DJI' => 'Djibouti',
            'DOM' => 'République dominicaine',
            'DMA' => 'Dominique',
            'EGY' => 'Égypte',
            'SLV' => 'Salvador',
            'ARE' => 'Émirats arabes unis',
            'ECU' => 'Équateur',
            'ERI' => 'Érythrée',
            'ESP' => 'Espagne',
            'EST' => 'Estonie',
            'USA' => 'États-Unis',
            'ETH' => 'Éthiopie',
            'FLK' => 'Îles Malouines',
            'FRO' => 'Îles Féroé',
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
            'HMD' => 'Îles Heard-et-MacDonald',
            'HND' => 'Honduras',
            'HKG' => 'Hong Kong',
            'HUN' => 'Hongrie',
            'IMN' => 'Île de Man',
            'UMI' => 'Îles mineures éloignées des États-Unis',
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
            'MNP' => 'Îles Mariannes du Nord',
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
            'MMR' => 'Birmanie',
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
            'IOT' => 'Territoire britannique de l\'océan Indien',
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
            'PCN' => 'Îles Pitcairn',
            'POL' => 'Pologne',
            'PYF' => 'Polynésie française',
            'PRI' => 'Porto Rico',
            'PRT' => 'Portugal',
            'QAT' => 'Qatar',
            'REU' => 'La Réunion',
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
            'VAT' => 'Vatican (Saint-Siège)',
            'VCT' => 'Saint-Vincent-et-les Grenadines',
            'SHN' => 'Sainte-Hélène',
            'LCA' => 'Sainte-Lucie',
            'SLB' => 'Salomon',
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
            'CZE' => 'République tchèque',
            'ATF' => 'Terres australes et antarctiques françaises',
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
            'VEN' => 'Venezuela',
            'VNM' => 'Viêt Nam',
            'WLF' => 'Wallis-et-Futuna',
            'YEM' => 'Yémen',
            'ZMB' => 'Zambie',
            'ZWE' => 'Zimbabwe',
        );

        // Récupérer le type de cuisine enregisté pour cette invitation
        $invitation_type_of_cuisine = $invitation->type_of_cuisine;

        // Récupérer le pays enregistré pour cette invitation
        $invitation_country = $invitation->country;

        // Récupérer la ville enregistrée pour cette invitation 
        $invitation_city = $invitation->city;
        /*
        $cities;

        // Récupérer toutes les villes d'un pays
        $allCountries = Pays::with('villes')->where('nom', $invitation_contry)->get();

        foreach($allCountries as $p){
            $cities = $p->villes->pluck('nom');
        }

        
*/
        $user =  Auth::user()->id;


        return view('invitations.edit', compact('invitation', 'user', 'countries', 'pays', 'invitation_type_of_cuisine'));
=======
    public function edit($id){

        // Récupérer l'invitation
        $invitation = Invitation::findOrFail($id);

        // Récupérer tous les pays
        $countries = Pays::all();

        $user =  Auth::user()->id;

        return view('invitations.edit', compact('invitation', 'user', 'countries'));
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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
<<<<<<< HEAD

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            // Générer un identifiant unique représentant le nom de cette image
            $fileName = uniqid().'.'.$image->extension();
            // Déplacer l'image dans l'emplacement
            $image->move(storage_path('app/public/plate-photos/'), $fileName);
            // Enregistrer le nom de l'image généré dans la bd
            $invitation->image = $fileName;
        }
=======
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        
        $invitation->direct_payment = $request->input('direct_payment');
        // Récupérer l'id de l'utilisateur qui crée l'invitation
        $invitation->user_id = $request->input('user_id');

        $invitation->update();

<<<<<<< HEAD
        return redirect()->route('invitation.my-tables')->withInformation(__('messages.Table modified successfully'));
=======
        return redirect()->route('invitation.my-tables')->with('info', 'Table modifiée avec succès.');
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
    }

    // Fonction permettant de supprimer définitivement une invitation
    public function destroy(Invitation $invitation) 
    {
        $invitation->delete();

<<<<<<< HEAD
        return back()->withInformation(__('The invitation has been permanently deleted'));
=======
        return back()->with('info', 'The invitation has been permanently deleted.');
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
    }

    // Valider une invitation (l'activer pour qu'elle soit visible) après sa création
    public function changeInvitationStatus(Request $request){
    	$invitation = Invitation::find($request->invitation_id);
    	$invitation->active = $request->active;
    	$invitation->save();

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
<<<<<<< HEAD
    public function showAllActiveInvitations() {

        $allCountries = Pays::all();

=======
    public function showAllActiveInvitations(Request $request) {

        $allCountries = Pays::all();

        //get user location
        //$ip = $request->ip(); 
        $ip = '162.159.24.227'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
        $user_country = Pays::where('nom', $currentUserInfo->countryName)->first();
        //get cities belong to country user
        $user_cities = Ville::where('pays_id', $user_country->id)
            ->limit(5)
            ->select('id', 'nom')
            ->get();

>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        // Récupérer toutes la colonne type_of_cuisine dans la table invitations
        $invit = DB::table('invitations')
        ->where('active', '=', 1)
        ->where('complete', '=', 0)
        ->distinct()->get(['type_of_cuisine']);

<<<<<<< HEAD
        return view('invitations.all-actives-invitations', compact('allCountries', 'invit'));
=======
        return view('invitations.all-actives-invitations', compact('allCountries', 'invit', 'user_cities'));
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
    }

    // Rechercher une invitation
    public function getData(Request $request){
            
        $country = $request->country;
        $city = $request->city;
        $type_of_cuisine = $request->type_of_cuisine;

        $invitatio = DB::table('users')
<<<<<<< HEAD
=======
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
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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
<<<<<<< HEAD

        $user =  Auth::user()->id;

=======
        $user =  Auth::user()->id;
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        $invitations = Invitation::withCount(['transactions' => function($query){
            $query->where('status', 'COMPLETED')
            ->where('transaction_type', 'Payment');
        }])->where('user_id', $user)->paginate(4);

        if(session('info')){
<<<<<<< HEAD
            Alert::success(session('info'), __('messages.LeTchoo will take 15% of your total turnover for this table'));
=======
            Alert::success('Title', session('info'));
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        }
                   
        return view('invitations.my-invitations', compact('user', 'invitations'));
    }

    // Lancer sa souscription (guest)
    public function subscribe(Invitation $invitation) 
    {
        $found_user_invitation = UserInvitation::where([
<<<<<<< HEAD
            ['invitation_id', $invitation->id],
            ['user_id', Auth::user()->id],
        ])->first();
        
        if($found_user_invitation) $found_user_invitation = true;
        else $found_user_invitation = false;

        // Récupérer l'identifiant de l'invitation
        $invitationID = $invitation->id;

        // Récupérer l'identifiant de l'utilisateur connecté
        $userID = Auth::user()->id;

        // Savoir si un utilisateur a déjà payé sur une table
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

        return view('invitations/subscribe', compact('invitation', 'found_user_invitation', 'size', 'activeUser'));
=======
                ['invitation_id', $invitation->id],
                ['user_id', Auth::user()->id],
        ])->first();

        if($found_user_invitation) $found_user_invitation = true;
        else $found_user_invitation = false;

        return view('invitations/subscribe', compact('invitation', 'found_user_invitation'));
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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

        return redirect()->route('invitation.my-invitations')->with('info', 'Well done');
    }

    // Afficher ses souscriptions (guest)
    public function myInvitations() {
        
        $user =  Auth::user()->id;
        
        $a = DB::select("select i.menu, i.type_of_cuisine, i.amountToBePaidByGuest, i.id, i.price, i.tax, i.currency, i.date, i.complete, iu.id, iu.activeUser, iu.created_at, iu.invitation_id
            from invitations i
            INNER JOIN invitation_user iu
            ON iu.invitation_id = i.id
            where iu.user_id = '$user' ");

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
<<<<<<< HEAD

        $invitation = UserInvitation::find($request->id);

        $invitation->activeUser = $request->activeUser;

=======
        $invitation = UserInvitation::find($request->id);
        $invitation->activeUser = $request->activeUser;
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        $invitation->save();
    }        

    // Laisser un bonus 
    public function bonus(Invitation $invitation) {
        return view('invitations.bonus', compact('invitation'));
    }
}
