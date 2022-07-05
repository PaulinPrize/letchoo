<x-app-layout>
    <x-slot name="header">

    </x-slot>
    
    <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
            <a class="btn btn-default float-right" href="{{ route('countries.index') }}">{{__('messages.Back')}}</a>
        </div>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <p>
                        {{__('messages.Name')}} : {{ $country->nom }}<br/>
                        {{__('messages.Currency')}} : {{ $country->currency }}<br/>
                        {{__('messages.Symbol')}} : {{ $country->symbol }}<br/>
                        {{__('messages.Tax')}} : {{ $country->tax }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout> 

