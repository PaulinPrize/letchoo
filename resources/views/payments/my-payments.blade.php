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
                                    <th class="text-center">Table</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">{{__('messages.Payment Status')}}</th>
                                    <th class="text-center">{{__('messages.Reference number')}}</th>
                                    <th class="text-center">{{__('messages.Amount')}}</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($myPayments as $myPayment)
                                    <tr>
                                        <td class="text-center">
                                            <small>{{ $myPayment->menu }}</small>
                                        </td>
                                        <td class="text-center">
                                            <small>{{ $myPayment->transaction_type }}</small>
                                        </td>
                                        <td class="text-center">
                                            <small>{{ $myPayment->status }}</small>
                                        </td>
                                        <td class="text-center">
                                            <small>{{ $myPayment->vendor_payment_id }}</small>
                                        </td>
                                        <td class="text-center">
                                            <small>
                                                {{ $myPayment->amount }} {{ $myPayment->currency_code }}
                                            </small> 
                                        </td>
                                        <td class="text-center">
                                            <small>{{ $myPayment->created_at }}</small>
                                        </td>
                                        @if($myPayment->transaction_type == 'Payment' && $today > $myPayment->date)
                                        @if($myPayment->transaction_type == 'Payment')
                                            <td class="text-center">
                                                <a 
                                                    class="btn btn-primary btn-sm " 
                                                    href="{{ route('invitation.bonus', $myPayment->id)}}"
                                                    role="button" 
                                                    data-toggle="tooltip"
                                                >
                                                    Laisser un pourboire
                                                </a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
                <div class="card-footer d-flex align-items-center justify-content-center">
                    {{ $myPayments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 