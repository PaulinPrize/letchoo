<?php

namespace App\Http\Livewire; 
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PragmaRX\Countries\Package\Countries;

class CountryCityCurrency extends Component
{
	public $countries;
	public $cities;
    public $currencies;
    

    public $selectedCountry = null;
    public $selectedCity = null;
    public $selectedCurrency = null;

    public function mount()
    {
    	$countries = new Countries();

        // Récupérer tous les pays
    	$this->countries = $countries->all()->pluck('name.common')->toArray();
    	$this->cities = collect();
    	$this->currencies = collect();

    }
    
    public function render()
    {
    	$user =  Auth::user()->id;
        return view('livewire.country-city-currency', compact('user'));
    }

    public function updatedSelectedCountry()
    {
        
    }	    

    public function updatedSelectedCity()
    {
        
    }
}
