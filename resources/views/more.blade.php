@extends('layouts/accueil')

@section('content')
	<div class="section2">
		<div class="container d-flex justify-content-center" style="height: 150vh;">

			<div class="row p-3" style="width: 100%; margin-top: 150px">
				<div class="col-md-6">

					<div class="row">
						<div class="col-md-12">
							@if($invitation->direct_payment == 1)
								<div class="alert alert-warning" role="alert" style="color: #ffffff;
									background-color:#FF9700; border-color: #FF9700;">
	  								<strong> <i class="fas fa-exclamation-triangle"></i> {{__('messages.To join this table you must pay directly.')}}</strong> 
	  							</div>
	  						@elseif($invitation->direct_payment == 0)
	  							<div class="alert alert-warning" role="alert" style="color: #ffffff;
									background-color:#FF9700; border-color: #FF9700;">
  									<strong> <i class="fas fa-exclamation-triangle"></i> {{__('messages.Your subscription must be approved by the host to join this table.')}}</strong> 
  								</div>
  							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>{{__('messages.Menu')}} - {{$invitation->menu}}</h3> 
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-12">
<<<<<<< HEAD
							@if($invitation->image == NULL)
								<img src="{{asset('public/storage/plate-photos/default.png')}}" class="img-rounded" style="height:350px; width: 100%"/>
							@else
								<img src="{{ asset('public/storage/plate-photos/'. $invitation->image) }}" class="img-rounded" style="height:350px; width: 100%">
							@endif
=======
							<img src="{{ asset('public/storage/plate-photos/'. $invitation->image) }}" class="img-rounded" style="height:350px; width: 100%">
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
						</div>
					</div>
					@if($invitation->description != null)
						<hr>
						<div class="row mt-3">
	          				<div class="col-md-12">
	          					<h3>{{__('messages.Description')}}</h3>
	          					<p style="font-size: 16px">{{$invitation->description}}</p>
	          				</div>
	          			</div>
	          		@endif

				</div>

				<div class="col-md-6">
					<div class="row">
						<div class="col-md-4">
							<h6>
								{{__('messages.Day')}}: {{ $invitation->date }} <br>{{__('messages.Hour')}}: {{ date('H:i', strtotime($invitation->heure));}}
							</h6>
						</div>
						<div class="col-md-4">
							@if($invitation->place != null)
								<h6>
									{{__('messages.Place')}} <br>{{$invitation->place}}
								</h6>
							@endif
						</div>
						<div class="col-md-4">
							@if($invitation->postal_code != null)
								<h6>
									{{__('messages.Postal code')}} <br>{{$invitation->postal_code}}
								</h6>
							@endif
						</div>
          			</div>
          			<div class="row mt-3">
	                	<div class="col-md-4">
	                  		<h6>{{$invitation->number_of_guests}} <br>{{__('messages.Guest(s)')}}</h6>
	                	</div>
	                	<div class="col-md-4">
				            <h6>{{__('messages.Complete ?')}}<br/>
					            @if($invitation->complete)
					                <label class="badge badge-success">Yes</label>
					            @else
					                <label class="badge badge-danger">No</label>
					            @endif
				            </h6> 
	                	</div>
	                	<div class="col-md-4">
	                  		<h6>{{__('messages.Price')}} <br/> {{$invitation->amountToBePaidByGuest}} {{$invitation->currency}}</h6>
	                	</div>
	              	</div>
	              	<div class="row mt-3">
          				<div class="col-md-12">
          					@if($invitation->direct_payment === 1)
          						<a href="{{route('invitation.subscribe', $invitation->id)}}" class="btn btn-lg btn-success" style="width:100%">{{__('messages.Pay directly')}}</a>
          					@elseif($invitation->direct_payment === 0)
          						<a href="{{route('invitation.subscribe', $invitation->id)}}" class="btn btn-lg btn-success" style="width:100%">{{__('messages.Subscribe')}}</a>
          					@endif
          				</div>
          			</div>

				</div>
			</div>

		</div>
	</div>
@endsection

@section('scripts')

@endsection