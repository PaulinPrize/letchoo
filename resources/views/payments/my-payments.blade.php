<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('My payments') }}</h2> 

        @include('flash::message')
        <div class="row">
            <div class="col-lg-12"> 
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Payment date</th>
                                        <th>Payment method</th>
                                        <th class="text-center">Reference number</th>
                                        <th class="text-center">Amount</th>
                                        <th>Menu</th>
                                        <th class="text-center">Payment validated</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($myPayments as $myPayment)
                                        <tr>
                                            <td>{{ $myPayment->updated_at }}</td>
                                            <td>{{ $myPayment->payment_method }}</td>
                                            <td>{{ $myPayment->reference_number }}</td>
                                            <td class="text-center">{{ $myPayment->amount }} {{ $myPayment->currency }}</td>
                                            <td>{{ $myPayment->menu }}</td>
                                            <td class="text-center">
                                                @if($myPayment->payment_status)
                                                    <label class="badge badge-success">Yes</label>
                                                @else
                                                    <label class="badge badge-danger">Not yet</label>
                                                @endif
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
    </x-slot>
</x-app-layout> 