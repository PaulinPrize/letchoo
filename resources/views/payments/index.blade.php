<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">{{ __('All payments') }}</h2> 

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
                                        <th class="text-center">Reference number</th>
                                        <th class="text-center">Amount</th>
						                <th>Paid by</th>
                                        <th class="text-center">InvitationID</th>
                                        <th>Menu</th>
                                        <th class="text-center">Confirm payment</th>
						            </tr>
        						</thead>
        						<tbody>
            						@foreach($allPayments as $payment)
            							<tr>
                                            <td>{{ $payment->reference_number }}</td>
                                            <td class="text-center">{{ $payment->amount }} {{ $payment->currency }}</td>
                    						<td>
                                                <small>{{ $payment->subscriber_name }}</small><br/>
                                                <small>{{ $payment->updated_at }}</small><br/>
                                                <small>{{ $payment->payment_method }}</small>
                                            </td>
                    						
                                            <td class="text-center">{{ $payment->invitation_id }}</td>
                                            <td>{{ $payment->menu }}</td>
                                            <td class="text-center">
                                                <input 
                                                    content="{{ $payment->id }}"
                                                    type="checkbox"
                                                    name="toggle"
                                                    {{ $payment->payment_status ? 'checked' : '' }}
                                                >
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