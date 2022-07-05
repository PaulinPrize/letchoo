<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">

        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

	            <div class="card-header py-3">
	                <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Set bonus')}}</h5>
	            </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('discounts.manage-amount') }}" tocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="host_amount">{{__('messages.Amount for hosts')}} <span class="small text-danger">*</span></label>
                                    <input type="number" id="host_amount" class="form-control" name="host_amount" value="{{ $coupon ? $coupon->host_amount : '' }}"/>
                                    @error('host_amount')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="guest_amount">{{__('messages.Amount for guests')}}</label>
                                    <input type="number" id="guest_amount" class="form-control" name="guest_amount" value="{{ $coupon ? $coupon->guest_amount : '' }}" />
                                    @error('guest_amount')
                                        <p class="text-sm text-red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>  
                            
	                    <div class="pl-lg-4">
	                        <div class="row">
	                            <div class="col text-center">
	                                <button type="submit" class="btn btn-primary">{{__('messages.Save')}}</button>
	                            </div>
	                        </div>
	                    </div>
                    </form>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</x-app-layout>