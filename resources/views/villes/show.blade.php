<x-app-layout>
    <x-slot name="header">

    </x-slot>
    
    <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
            <a class="btn btn-default float-right" href="{{ route('villes') }}">{{__('messages.Back')}}</a>
        </div>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <p>
                        {{__('messages.Name')}} : {{ $ville->nom }}<br/>
                        {{__('messages.Postal code')}} : {{ $ville->ville_code_postal }}<br/>
                        Longitude_deg : {{ $ville->ville_longitude }}<br/>
                        Latitude_deg : {{ $ville->ville_latitude }}<br/>
                        Longitude_grd : {{ $ville->ville_longitude_grd }}<br/>
                        Latitude_grd : {{ $ville->ville_latitude_grd }}<br/>
                        Longitude_dms : {{ $ville->ville_longitude_dms }}<br/>
                        Latitude_dms : {{ $ville->ville_latitude_dms }}<br/>
                        Ville_zmin : {{ $ville->ville_zmin }}<br/>
                        Ville_zmax : {{ $ville->ville_zmax }}<br/>
                        {{__('messages.Country')}} : {{$ville->pays->nom}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout> 

