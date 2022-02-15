<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Invitation details') }}
                </h2>
            </div>
            <div class="col-sm-6">
                <!--
                <a class="btn btn-default float-right" href="{{ route('invitations') }}">Back</a>
                -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header">Menu : {{ $invitation->menu }}</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <img class="d-block w-100" src="{{ asset('public/storage/plate-photos/'. $invitation->image) }}"/>
                            </div>
                        </div>
                        <hr>
                        <p class="card-text" style="font-size:16px">{{ $invitation->description }}</p>
                        <hr>
                        <p style="font-size:16px">
                            <u>Type of cuisine</u> : {{ $invitation->type_of_cuisine }}<br>
                            <u>Num of guests</u> : {{ $invitation->number_of_guests }}<br>
                            <u>Price</u> : {{ $invitation->price }} {{ $invitation->currency }}<br>
                        </p>
                        <hr>
                        <p style="font-size:16px">
                            <u>Country</u> : {{ $invitation->country }}<br>
                            <u>City</u> : {{ $invitation->city }}<br>
                            <u>Place</u> : {{ $invitation->place }}<br>
                            <u>Tax</u> : {{ $invitation->tax }}<br>
                        </p>
                        <hr>
                        <p style="font-size:16px">
                            <u>Date</u> : {{ $invitation->date }} {{ date('H:i', strtotime($invitation->heure));}}<br>
                        </p>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout> 

