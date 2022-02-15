<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold"></h2> 
            
        @include('flash::message')
        <div class="row">
            <div class="col-lg-4">
                
            </div>
            <div class="col-lg-4"> 
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary text-center">PAYPAL</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('invitation.paypal-payment')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!--
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name', '') }}"/>
                                        @error('name')
                                            <p class="text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" id="payer_id" class="form-control" name="payer_id"  value="{{ Auth::user()->id}}" hidden/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" id="paid_by" class="form-control" name="paid_by"  value="{{ Auth::user()->name}}" hidden/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="invitation_user_id" class="form-control" name="invitation_user_id" value="{{$iuID}}" hidden/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="payment_method" class="form-control" name="payment_method" value="paypal" hidden/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" id="amount" class="form-control" name="amount" value="{{$amount}}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" id="currency" class="form-control" name="currency" value="{{$currency}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-primary">Pay</button>
                            </div>
                        </form>
                    </div> 
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-app-layout> 


