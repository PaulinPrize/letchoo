<x-app-layout>
    <x-slot name="header"></x-slot>
    <!--
    <div class="row mb-2">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <a class="btn btn-default float-right" href="{{ route('invitations') }}">{{__('messages.Back')}}</a>
        </div>
    </div>
    -->
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <h5 class="card-header">{{__('messages.Menu')}} : {{ $invitation->menu }}</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
<<<<<<< HEAD
                            @if($invitation->image == NULL)
                                <img class="d-block w-100" src="{{asset('public/storage/plate-photos/default.png')}}" style="height:400px"/>
                            @else
                                <img class="d-block w-100" src="{{ asset('public/storage/plate-photos/'. $invitation->image) }}"/>
                            @endif
=======
                            <img class="d-block w-100" src="{{ asset('public/storage/plate-photos/'. $invitation->image) }}"/>
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
                        </div>
                    </div>
                    <hr>
                    @if($invitation->description != null)
                        <p class="card-text" style="font-size:16px">{{ $invitation->description }}</p>
                        <hr>
                    @endif
                    <p style="font-size:16px">
                        <u>{{__('messages.Type of cuisine')}}</u> : {{ $invitation->type_of_cuisine }}<br>
                        <u>{{__('messages.Number of guests')}}</u> : {{ $invitation->number_of_guests }}<br>
                        <u>{{__('messages.Price')}}</u> : {{ $invitation->price }} {{ $invitation->currency }}<br>
                    </p>
                    <hr>
                    <p style="font-size:16px">
                        <u>{{__('messages.Country')}}</u> : {{ $invitation->country }}<br>
                        <u>{{__('messages.City')}}</u> : {{ $invitation->city }}<br>
                        <u>{{__('messages.Place')}}</u> : {{ $invitation->place }}<br>
                        <u>{{__('messages.Postal code')}}</u> : {{ $invitation->postal_code }}<br>
                        <u>{{__('messages.Tax')}}</u> : {{ $invitation->tax }}<br>
                    </p>
                    <hr>
                    <p style="font-size:16px">
                        <u>{{__('Date')}}</u> : {{ $invitation->date }}<br>
                        <u>{{__('messages.Hour')}}</u> : {{ date('H:i', strtotime($invitation->heure));}}<br>
                    </p>
                    <hr>
                    <p style="font-size:16px">
                        {{__('messages.Table status')}} : 
                        @if($invitation->active == 1)
                            <label class="badge badge-success">{{__('messages.OPENED')}}</label>
                        @else
                            <label class="badge badge-danger">{{__('messages.CLOSED')}}</label>
                        @endif
                        <br>
                        {{__('messages.Table complete')}} :
                        @if($invitation->complete)
                            <label class="badge badge-success">{{__('messages.YES')}}</label>
                        @else
                            <label class="badge badge-danger">{{__('messages.NO')}}</label>
                        @endif
                        <br>
                        {{__('messages.Direct payment')}} :
                        @if($invitation->direct_payment)
                            <label class="badge badge-success">{{__('messages.YES')}}</label>
                        @else
                            <label class="badge badge-danger">{{__('messages.NO')}}</label>
                        @endif
                    </p>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</x-app-layout> 


