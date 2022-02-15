@extends('layouts/accueil')

@section('content')
	<div class="row" style="margin-top: 111px">
		<div class="col-sm-12 mt-5">
	    	<h1 class="text-center">{{$invitation->menu}}</h1>
	      	<h6 class="text-center">{{ $invitation->date }} {{ date('H:i', strtotime($invitation->heure));}}</h6>
	      	<h6 class="text-center">{{$invitation->type_of_cuisine}}</h6>
	      	<div class="row">
			    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:15px">
			    	<img src="{{ asset('public/storage/plate-photos/'. $invitation->image) }}" width="100%" height="100%" />
			    </div>
			    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:15px">
				    <!--
		          	<div class="row">
		          		<div class="col-lg-12">
			              	<div class="row">
			                	<div class="col-lg-2">
			                  	<img src="{{ $invitation->user_id }}" width="50" height="50" alt="image de profil" class="image rounded-circle">
			                	</div>
			                	<div class="col-lg-10">
			                  	<small>Posted by : {{$invitation->user_id}}</small>
			                	</div>
			              	</div>
	            		</div>
		          	</div><br>
		          	-->
		          	<div class="row">
	            		<div class="col-lg-12">
	              			<div class="row">
	                			<div class="col-lg-4">
	                  				<h6><strong>{{$invitation->number_of_guests}}</strong> <br>Guest(s)</h6>
	                			</div>
	                			<div class="col-lg-4">
				                  	<h6>
					                  	Complete ?<br/>
					                    @if($invitation->complete)
					                    	<label class="badge badge-success">Yes</label>
					                    @else
					                        <label class="badge badge-danger">No</label>
					                    @endif
				                    </h6> 
	                			</div>
	                			<div class="col-lg-4">
	                  				<h6>Price <br/> <strong>{{$invitation->total}} {{$invitation->currency}}</strong></h6>
	                			</div>
	              			</div>
	            		</div>
	          		</div><br>
	          		<div class="row">
	            		<div class="col-lg-12">
			              	<div class="row">
			                	<div class="col-lg-4">
			                  	<h6> Counrty<br> <strong>{{$invitation->country}}</strong></h6>
			                	</div>
			                	<div class="col-lg-4">
			                  	<h6>City<br> <strong>{{$invitation->city}}</strong></h6>
			                	</div>
			                	<div class="col-lg-4">
			                  	<h6>Place<br> <strong>{{$invitation->place}}</strong>
			                	</div>
			              	</div>
	            		</div>
	          		</div><br>
		          	<div class="row">
		            	<div class="col-lg-12">
		            		<a href="{{route('invitation.subscribe', $invitation->id)}}" class="btn btn-lg btn-success" style="width:100%">Subscribe</a>
		            	</div>
		          	</div>
		       	</div>
			</div>
			<div class="row">
        		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:15px;word-wrap:break-word;">
        			<p style="font-size:14pt">{{$invitation->description}}</p>
        		</div>
			</div>
	    </div>
	</div>

@endsection
