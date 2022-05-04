<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Leave a bonus') }}
        </h2>
        <div class="row justify-content-center">

            <div class="col-md-6 order-lg-1">

                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Leave a bonus</h5>
                    </div>

                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::label('amount', 'Montant:') !!}
                                                {!! Form::number('amount', null, ['class' => 'form-control', 'min' => '0.00', 'id' => 'amount']) !!}
                                                <small class="form-text text-muted">eg: 150 {{$invitation->currency}}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="currency">Choose currency *</label>
                                                <select class="form-control" id="currency" name="currency">
                                                    <option value="EUR">EUR</option>
                                                    <option value="EUR">USD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->

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
                    </form>
                </div>

            </div>

        </div>
        
    </x-slot>
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
                        invitation_id: "{{$invitation->id}}" ,
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
                        type: "bonus"  
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



