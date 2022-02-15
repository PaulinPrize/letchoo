<x-app-layout>
    <x-slot name="header">

        <h2 class="h4 font-weight-bold">
            
        </h2>

        <div class="row p-3"> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
            	<div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <select class="form-control form-control-lg" id="country_id" name="country">
                            <option value="" selected>Choose country</option>
                            @foreach($allCountries as $country)
                    		<option value="{{$country}}">{{$country}}</option>
                			@endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6" id="city">
                        <select class="form-control form-control-lg" id="city_id" name="city">
               				<option value="">Choose city</option>
            			</select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control form-control-lg" name="type_of_cuisine" id="type_of_cuisine">
                        	<option selected>Choose type of cuisine</option>
                        	@foreach($invit as $inv)
                        		<option value="{{$inv->type_of_cuisine}}">{{$inv->type_of_cuisine}}</option>
                        	@endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-outline-secondary btn-block" id="submit_form">{{ __('Search') }}
                        </button>
                    </div>
            	</div>
            </div>
        </div>
        <div class="row mt-5 p-3" id="display-data"></div>        
        @section('scripts')
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		    <script type="text/javascript">
		    	$(document).ready(function () {
		    		$('#country_id').change(function(){
		    			// Récupérer le pays sélectionné
		                var city = $(this).val();
		                $('#city_id').empty();
		                $.ajax({
		                	url: "./../cities/"+city,
		                	success: function(data) {
                                //console.log(data.villes)
		                        $.each(data.villes, function(value1, value2){
		                            $('<option value="' + value2 + '">' + value2 + '</option>').appendTo('#city_id');
		                        });
                    		}
		                });
		    		});
		    		$("#submit_form").on("click", function(){
                        var data ={
                            'country': $("#country_id").val(),
                            'city': $("#city_id").val(),
                            'type_of_cuisine': $("#type_of_cuisine").val(),
                        }
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        });
			    		$.ajax({
                            type: "POST",
			    			url: "./../getData",
			    			data: data,
                            dataType: "json",
			    			success: function(response){
                                console.log(response)
                                $('#display-data').empty();
                                $.each(response, function(index, item) {
                                   $('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 30px;">\n\
                                        <div class="card h-100 shadow">\n\
                                            <a href="../invitation/more/'+ item.id +'">\n\
                                            <img class="card-img-top" src="../public/storage/plate-photos/'+ item.image +'" style="width: 100%; height: 20vw; object-fit: cover;">\n\
                                            </a>\n\
                                            <div class="card-body">\n\
                                                <p class="text-center text-uppercase text-truncate">\n\
                                                    <a href="../invitation/more/'+ item.id +'">\n\
                                                    ' + item.menu + '</a>\n\
                                                    <h5 class="text-center text-uppercase text-truncate" >\n\
                                                    <small style="text-align:center">\n\
                                                    '+ item.total +' ' + item.currency + '\n\
                                                    </small>\n\
                                                    </h5>\n\
                                                </p>\n\
                                            </div>\n\
                                            <div class="card-footer text-truncate">\n\
                                                <small>\n\
                                                    <img src="../public/storage/'+ item.profile_photo_path +'" style="width:25px; height:25px; border-radius:50%"/>\n\
                                                    Posted by : ' + item.name + '\n\
                                                </small>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>').appendTo('#display-data');
                                })
			    			}
			    		});			    		
		    		});
		    	});
		    	
		    </script>
		    
		@endsection
    </x-slot>
</x-app-layout>

