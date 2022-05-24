<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-lg-12">
        	@if($paymentMethod === 0)
        		<div class="row">
	        		<div class="col-md-12">

	        			<div class="row mb-3">
		        			<div class="col-md-12">
								<div class="alert alert-warning" role="alert">
									<i class="fas fa-exclamation-triangle"></i> You have not yet chosen your method of receiving payments.
								</div>
							</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-lg-3"></div>
		            		<div class="col-md-6">
		            			<div class="card mb-4">
			                    	<div class="card-body">
			                    		<div class="row">
									    	<div class="col-lg-12 col-md-12">
									    		<div class="row">
										        	<div class="col-md-12">
										        		<p class="text-center">Choosing a receive payment method will allow us to transfer all your income to you.</p>
										        	</div>
									        	</div>
									        	<hr class="mb-3">
									        	<div class="row mb-2">
									        		<div class="col-md-12">
									        			<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal1" id="open">
	  														<i class="fab fa-paypal"></i> PayPal
														</button>
														<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<form method="post" action="{{url('payment/store-paypal-receive-payment-method')}}">
																	<div class="modal-content">
																		<div class="modal-header">
				        													<h5 class="modal-title" id="exampleModalLabel">Enter your PayPal Account</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
				      													</div>
				      													<div class="modal-body">
				      														<div class="alert alert-danger" style="display:none"></div>
				      														<input type="hidden" name="_token" value="{{ csrf_token() }}">
			          														<div class="form-group">
																		        <label for="paypal_email" class="col-form-label">PayPal email:</label>
																		        <input type="email" class="form-control" id="paypal_email" name="paypal_email" value="{{ old('paypal_email', '') }}"
																		        required/>
			          														</div>
			          														<div class="form-group">
																		        <input type="number" class="form-control" id="model_id" name="model_id" value="{{Auth::user()->id}}" hidden>
			          														</div>
				      													</div>
				      													<div class="modal-footer">
																        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																        	<button type="submit" id="paypal" class="btn btn-primary">Save</button>
				      													</div>
																	</div>
																</form>
															</div>
														</div>
									        		</div>
									        	</div>
										        <div class="row">
										        	<div class="col-md-12">
										        		<button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal2" disabled>
		  													<i class="fas fa-credit-card"></i> Bank transfer
														</button>
										        	</div>
										        </div>
									    	</div>
									    </div>
									</div>
								</div>
		            		</div>
	        			</div>

	        		</div>
	        	</div>
        	@else
        		<div class="row">
        			<div class="col-md-12">
        			
	        			<div class="row">
		        			<div class="col-md-3 col-lg-3"></div>
			            	<div class="col-md-6 col-lg-6">
			            		@if(!empty(Auth::user()->paypal_email))
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
	    									<div class="flex-column"><strong>Receive payment method</strong></div>
	  									</li>
	  									<li class="list-group-item d-flex justify-content-between align-items-center">
	    									<div class="flex-column">
										    	PayPal 
										      	<p><small>{{Auth::user()->paypal_email}}</small></p>
										      	<!--
	      										<button type="button" class="btn btn-outline-primary btn-sm" disabled>Set as default</button>
	      										-->
	    									</div>
	    									<div style="max-width: 60px;">
	        									<img src="{{asset('public/img/PP.jpg')}}" class="img-thumbnail" alt="PayPal" >
	    									</div>
	  									</li>
									</ul>
								@else
									<span class="alert-danger">Informations introuvables</span>
								@endif
			            	</div>
			            </div>
        			</div>
        		</div>
        	@endif
        </div>
    </div>
	@section('scripts')
        <!--
        <script type="text/javascript">
        	$(document).ready(function(){
        		$('#addForm').on('submit', function(e){
        			e.preventDefault();
        			$.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    });
        			$.ajax({
        				type: "POST",
        				url: "../payment/store-paypal-receive-payment-method",
        				data: $('addForm').serialize(),
        				success: function(response){
        					console.log(response)
        					$('#exampleModal1').modal('hide')
        					alert("Data saved");
        				},
        				error: function(error){
        					console.log(error)
        					alert("Data not saved");
        				}
        			});
        		});
        	});
        </script>
        -->
    @endsection
</x-app-layout> 