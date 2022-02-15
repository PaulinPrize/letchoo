<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            
        </h2> 

        <div class="row"> 
        	<div class="col-lg-3"></div>
            <div class="col-lg-6 order-lg-1">

            	<div class="card shadow mb-4">

	                <div class="card-header py-3">
	                    <h5 class="m-0 font-weight-bold text-primary"></h5>
	                </div>
	                <form action="" method="post">
	                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                	<div class="card-body">
	                		<script src='https://js.stripe.com/v2/' type='text/javascript'></script>
							<form accept-charset="UTF-8" action="/" class="require-validation"
								data-cc-on-file="false" data-stripe-publishable-key="pk_test_51IWNxtKEfvkV8aGdxApdNwOLDi6IM0dvii541Vj53rO573Bnf9VDKfAi7tDmO8803a5YcgCXq2uNEIP9osnq3zWl00mVyfCrdZ"
								id="payment-form" method="post">
	                		
	                			{{ csrf_field() }}

	                			<div class="row">
		                			<div class="form-group col-sm-12 required">
										<label class="form-control-label">Name on card </label> 
		                                <input class='form-control' size='4' type='text'>
		                			</div>
	                			</div>

	                			<div class="row">
		                			<div class="form-group col-sm-12 required">
										<label class="form-control-label">Card number</label> 
		                                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
		                			</div>
	                			</div>

	                			<div class="row mb-3">
		                			<div class="form-group col-sm-4 cvc required">
										<label class="form-control-label">CVV</label> 
		                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
		                			</div>
		                			<div class="form-group col-sm-4 expiration required">
		                				<label class="form-control-label">Expiration</label> 
		                				<input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
		                			</div>
		                			<div class="form-group col-sm-4 expiration required">
		                				<label class="form-control-label"></label> 
		                				<input class='form-control card-expiry-year' placeholder='YYYY' size='4'type='text'>
		                			</div>
	                			</div>

	                			<div class="row mb-3">
		                			<div class="col-sm-12">
		                				<div class='form-control total btn btn-info'>
	                						Total: <span class='amount'>$300</span>
	            						</div>
		                			</div>
	                			</div>

		                		<div class="row mb-3">
		                			<div class="form-group col-sm-12">
		                				<button class='form-control btn btn-primary submit-button'
	                						type='submit'>Pay »
	                					</button>
		                			</div>
		                		</div>

		                		<div class="row">
		                			<div class="form-group col-sm-12 error hide">
		                				<div class='alert-danger alert'>Please correct the errors and try again.</div>
		                			</div>
		                		</div>

	                		</form>

							@if ((Session::has('success-message')))
							<div class="alert alert-success col-md-12">{{Session::get('success-message') }}</div>
							@endif @if ((Session::has('fail-message')))
							<div class="alert alert-danger col-md-12">{{Session::get('fail-message') }}</div>
							@endif

	                	</div>

                	</form>
                </div>

            </div>
        </div>
        <script>
        	$(function() {
				$('form.require-validation').bind('submit', function(e) {
					var $form = $(e.target).closest('form'),
				   	inputSelector = [
				   		'input[type=email]', 'input[type=password]',
				        'input[type=text]', 'input[type=file]',
				        'textarea'
				    ].join(', '),
				    $inputs = $form.find('.required').find(inputSelector),
				    $errorMessage = $form.find('div.error'),
				    valid = true;

					$errorMessage.addClass('hide');
				    $('.has-error').removeClass('has-error');

				    $inputs.each(function(i, el) {
				    	var $input = $(el);
				    	if ($input.val() === '') {
				        	$input.parent().addClass('has-error');
				        	$errorMessage.removeClass('hide');
				        	e.preventDefault(); // cancel on first error
				      	}
				    });
				});
			});

        	$(function() {
				var $form = $("#payment-form");
				$form.on('submit', function(e) {
					if (!$form.data('cc-on-file')) {
					    e.preventDefault();
					    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
					    Stripe.createToken({
					    	number: $('.card-number').val(),
					        cvc: $('.card-cvc').val(),
					        exp_month: $('.card-expiry-month').val(),
					        exp_year: $('.card-expiry-year').val()
					    }, stripeResponseHandler);
					}
				});

			function stripeResponseHandler(status, response) {
				if (response.error) {
				    $('.error')
				        .removeClass('hide')
				        .find('.alert')
				        .text(response.error.message);
				} else {
				    // token contains id, last4, and card type
				    var token = response['id'];
				    // insert the token into the form so it gets submitted to the server
				    $form.find('input[type=text]').empty();
				    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
				    $form.get(0).submit();
				}
			}

		});

       </script>
    </x-slot>
</x-app-layout>


