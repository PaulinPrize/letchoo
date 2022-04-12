@extends('layouts/accueil')

@section('content')
    <div class="row" style="margin-top: 111px">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mt-5 mb-5 shadow">
                        <div class="card-header py-3 bg-white">
                            <h5 class="m-0 font-weight-bold text-primary">Validate your command</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <!--
                                    <p class="lead">Guest</p>
                                    <hr>
                                    <p>{{Auth::user()->name}}<br></p>
                                    -->
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Menu</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub total</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>
                                                <!--<img src="{{ asset('public/storage/plate-photos/'. $invitation->image) }}" class="img-circle" style="width:60px; height:60px;"/>-->
                                                {{$invitation->menu}}
                                            </td>
                                            <td>1</td>
                                            <!--
                                            <td>{{$invitation->price}} {{$invitation->currency}}</td>
                                            <td>{{$invitation->price}} {{$invitation->currency}}</td>
                                            -->
                                            <td>{{$invitation->total}} {{$invitation->currency}}</td>
                                            <td>{{$invitation->total}} {{$invitation->currency}}</td>
                                        </tr>
                                        <tr class="text-center">
                                            <td colspan="3"></td>
                                            <td><strong>Total : {{$invitation->total}} {{$invitation->currency}}</strong> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>
                                        Amount in words : {{ NumConvert::word(($invitation->price+($invitation->price*$invitation->tax)/100)+(($invitation->price*10)/100) )}}<br>
                                        Pay until : {{$invitation->date}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer  text-center ">
                            @if($invitation->direct_payment == 0)
                                <form method="POST" action="{{ route('invitation.validation') }}" autocomplete="off">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="number" id="user_id" class="form-control" name="user_id" value="{{Auth::user()->id}}" hidden/>       
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="text" id="subscriber_name" class="form-control" name="subscriber_name" value="{{Auth::user()->name}}" hidden/>       
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="number" id="invitation_id" class="form-control" name="invitation_id" value="{{$invitation->id}}" hidden/>       
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="text" id="menu" class="form-control" name="menu" value="{{$invitation->menu}}" hidden/>       
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="number" id="owner_id" class="form-control" name="owner_id" value="{{$invitation->user_id}}" hidden/>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="number" id="amount" class="form-control" name="amount" value="{{$invitation->total}}" hidden/>       
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" id="currency" class="form-control" name="currency" value="{{$invitation->currency}}"hidden/>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pl-lg-4">
                                        @if(Auth::user()->id == $invitation->user_id )
                                            <div class="alert alert-danger" role="alert">
                                                Sorry, you cannot subscribe to your own table
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col text-center">
                                                    <button type="submit" class="btn btn-primary">Validate</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            @else
                                <form autocomplete="off">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="number" id="user_id" class="form-control" name="user_id" value="{{Auth::user()->id}}" hidden/>       
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="number" id="invitation_id" class="form-control" name="invitation_id" value="{{$invitation->id}}" hidden/>       
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="number" id="owner_id" class="form-control" name="owner_id" value="{{$invitation->user_id}}" hidden/>       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="menu" id="menu" class="form-control" name="menu" value="{{$invitation->menu}}" hidden/>       
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="amount" id="amount" class="form-control" name="amount" value="{{$invitation->total}}" hidden/>       
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="currency" id="currency" class="form-control" name="currency" value="{{$invitation->currency}}" hidden/>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pl-lg-4">
                                        @if(Auth::user()->id == $invitation->user_id )
                                            <div class="alert alert-danger" role="alert">
                                                Sorry, you cannot subscribe to your own table
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-4 text-center">
                                                    <!--
                                                    <a class="btn btn-primary btn-sm " href="" role="button" data-toggle="tooltip">
                                                        Proceed to payment
                                                    </a>
                                                    -->
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

        @section('scripts')
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
                        'currency_code': "{{$invitation->currency}}",
                        'user_id' : "{{auth()->user()->id}}",
                        'amount' : $("#amount").val(),
                        'invitation_id': $("#invitation_id").val(),
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
                        invitation_id: $("#invitation_id").val(),
                        user_id: "{{ auth()->user()->id }}",
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
    @endsection

