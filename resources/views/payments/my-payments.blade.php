<x-app-layout>
    <x-slot name="header"></x-slot>
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary float-left">{{__('messages.My payments')}}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">{{__('messages.Reference number')}}</th>
                                    <th class="text-center">{{__('messages.Amount')}}</th>
                                    <th class="text-center">{{__('messages.Payment Status')}}</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Invitation</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($myPayments as $myPayment)
                                    <tr>
                                        <td class="text-center">{{ $myPayment->vendor_payment_id }}</td>
                                        <td class="text-center">{{ $myPayment->user }}</td>
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