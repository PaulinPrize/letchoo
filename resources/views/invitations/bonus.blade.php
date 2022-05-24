<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row justify-content-center">

        <div class="col-md-6 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Leave a tip')}}</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('amount', 'Montant :') !!}
                                        {!! Form::number('amount', null, ['class' => 'form-control', 'min' => '0.00', 'id' => 'amount']) !!}
                                        <small class="form-text text-muted">{{__('messages.Currency taken into account for this table')}} : {{$invitation->currency}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-md-12">
                            @if(Auth::user()->id == $invitation->user_id )
                                <div class="alert alert-danger" role="alert">
                                    {{__('messages.Sorry, you can not leave bonus to your own table')}}
                                </div>
                            @else
                                <div id="paypal-button-container"></div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
        
    
</x-app-layout>

<script src="{{ asset('public/js/iziToast.min.js') }}"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency={{$invitation->currency}}"></script>

<script>

    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
    // Call your server to set up the transaction
             createOrder: function(data, actions) {
                return fetch('../../api/paypal/order/create', {
                    method: 'POST',
                    body:JSON.stringify({
                        currency_code: "{{$invitation->currency}}",
                        user_id : "{{auth()->user()->id}}",
                        amount : $("#amount").val(),
                        invitation_id: "{{$invitation->id}}",
                        order_type : "Tip",
                        transaction_type : "Tip",
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('../../api/paypal/order/capture' , {
                    method: 'POST',
                    body :JSON.stringify({
                        orderId : data.orderID,
                        invitation_id: "{{$invitation->id}}",
                        user_id: "{{ auth()->user()->id }}", 
                        type: "bonus",
                        order_type : "Tip",
                        transaction_type : "Tip",  
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {

                    // Successful capture! For demo purposes:
                  //  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    iziToast.success({
                        title: 'Success',
                        message: 'Payment completed',
                        position: 'topRight'
                    });
                });
            }

    }).render('#paypal-button-container');

</script>



