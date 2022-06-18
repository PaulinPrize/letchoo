<?php

namespace App\Http\Controllers;
use App\Models\Ville;
use App\Models\Pays;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villes = Ville::paginate(20);      
        return view('villes.index', compact('villes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pays = Pays::all();
        return view('villes.create', compact('pays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'bail|required|string|max:255',
            'ville_code_postal' => 'nullable|string|max:10',
            'ville_longitude' => 'nullable|numeric',
            'ville_latitude' => 'nullable|numeric',
            'ville_longitude_grd' => 'nullable|numeric',
            'ville_latitude_grd' => 'nullable|numeric',
            'ville_longitude_dms' => 'nullable|numeric',
            'ville_latitude_dms' => 'nullable|numeric',
            'ville_zmin' => 'nullable|numeric',
            'ville_zmax' => 'nullable|numeric',
            'pays_id' => 'required',
        ]);

        Ville::create($request->all());

        return redirect()->route('villes')->with('info', 'La ville a été crée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ville $ville)
    {
        return view('villes.show', compact('ville'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ville $ville)
    {
        $pays = Pays::all();
        return view('villes.edit', compact('ville', 'pays'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ville $ville)
    {
        $request->validate([
            'nom' => 'bail|required|string|max:255',
            'ville_code_postal' => 'nullable|string|max:10',
            'ville_longitude' => 'nullable|numeric',
            'ville_latitude' => 'nullable|numeric',
            'ville_longitude_grd' => 'nullable|numeric',
            'ville_latitude_grd' => 'nullable|numeric',
            'ville_longitude_dms' => 'nullable|numeric',
            'ville_latitude_dms' => 'nullable|numeric',
            'ville_zmin' => 'nullable|numeric',
            'ville_zmax' => 'nullable|numeric',
            'pays_id' => 'required',
        ]);

        $ville->update($request->all());

        return redirect()->route('villes')->with('info', 'La ville a été modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ville $ville)
    {
        $ville->delete();
    
        return redirect()->route('villes')->with('info','Ville supprimée avec succès.');
    }
}
