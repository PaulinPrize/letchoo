<x-app-layout>
    <x-slot name="header"></x-slot>
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary float-left">
                        <th class="text-center">{{__('messages.All payments')}}</th>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>{{__('messages.Menu')}}</th>
                                    <th>Date</th>
                                    <th class="text-center">{{__('messages.Guests')}}</th> 
                                    <th class="text-center">{{__('messages.Country')}}</th>
                                    <th class="text-center">{{__('messages.City')}}</th>
                                    <th class="text-center">{{__('messages.Place')}}</th>
                                    <th class="text-center">{{__('messages.Postal code')}}</th>
                                    <th class="text-center"></th>                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allPayments as $payment)
                                    <tr>
                                        <td class="text-center">{{$payment->id}}</td>
                                        <td>{{$payment->menu}}</td>
                                        <td>{{ $payment->date }} {{ date('H:i', strtotime($payment->heure));}}</td>
                                        <td class="text-center">{{$payment->transactions_count}}/{{$payment->number_of_guests}}</td>
                                        <td class="text-center">{{$payment->country}} ({{__('messages.Tax')}}:{{$payment->tax}})</td>
                                        <td class="text-center">{{$payment->city}}</td>
                                        <td class="text-center">{{$payment->place}}</td>
                                        <td class="text-center">{{$payment->postal_code}}</td>
                                        <!--
                                        <td class="text-center">
                                            @foreach($payment->transactions as $transaction)
                                            <small>
                                                @if ($loop->first) {{$transaction->user->name}} @endif
                                            </small>  
                                            @endforeach
                                        </td>
                                        -->
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm " href="{{ route('payment-detail', [$payment->id]) }}" target="_blank" role="button" data-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
                <div class="card-footer">
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 