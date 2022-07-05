<?php

namespace App\Http\Controllers;
use App\Models\Pays;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Pays::paginate(10);      
        return view('pays/index', compact('countries')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pays.create');
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
            'nom' => 'bail|required|string|max:255|unique:pays',
            'currency' => 'bail|required|string|max:10',
            'symbol' => 'bail|required|string|max:5',
            'tax' => 'bail|required|numeric|min:0',
        ]);

        Pays::create($request->all());

        return redirect()->route('countries.index')->with('info', 'Le pays a bien été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pays $country)
    {
        return view('pays.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pays $country)
    {
        //$country = Pays::findOrFail($id);
        return view('pays.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pays $country)
    {
        $request->validate([
            'nom' => 'bail|required|string|max:255',
            'currency' => 'bail|required|string|max:10',
            'symbol' => 'bail|required|string|max:5',
            'tax' => 'bail|required|numeric|min:0',
        ]);

        $country->update($request->all());

        return redirect()->route('countries.index')->with('info', 'Le pays a bien été créé');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pays $country)
    {
        $country->delete();
    
        return redirect()->route('countries.index')->with('info','Pays supprimé avec succès.');
    }
}
