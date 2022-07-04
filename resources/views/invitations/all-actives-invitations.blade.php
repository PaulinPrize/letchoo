<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="row">
        <div class="col-lg-12 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Find a table')}}</h5>
                </div>
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">

                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                    <select class="form-control form-control-lg" id="country_id" name="country">
                                        <option value="" selected>Choose country</option>
                                        @foreach($allCountries as $country)
                                            <option value="{{$country->nom}}">{{$country->nom}}</option>
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
                                        @foreach($invit as $i)
                                        <option value="{{$i->type_of_cuisine}}">{{$i->type_of_cuisine}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col" id="content-spinner">
                                    <button class="btn btn-outline-secondary btn-block" id="submit_form">{{ __('Search') }}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-5 p-3 " id="display-data"></div>

                </div>
                <div class="card-footer"></div>
            </div>
        </div> 
    </div>  

    @section('scripts')
        <script src="{{ asset('public/js/Xhttp_ActiveX.js') }}"></script>
		  <script type="text/javascript">
		    $(document).ready(function () {
		    	$('#country_id').change(function(){
		    		// Récupérer la ville correspondant au pays sélectionné
		          var name = $(this).val();

		            $('#city_id').empty();
		            $.ajax({
		                url: "./../country/"+name,
		                success: function(data) {
		                    $.each(data.villes, function(value1, value2){
		                        $('<option value="' + value2 + '">' + value2 + '</option>').appendTo('#city_id');
		                    });
                    	}
		            });
		    	});

		    	$("#submit_form").on("click", function() {

                    $('#no-found').remove()

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

                    $('<div class="row justify-content-center"><div class="spinner-border" style="color: #882E57">\n\
                        <span class="sr-only">Chargement...</span>\n\
                        </div></div>').appendTo('#content-spinner');

                        $(this).css('visibility', 'hidden'); 

			    		$.ajax({
                            type: "POST",
			    			url: "./../getData",
			    			data: data,
                            dataType: "json",
                            
			    			success: function(response){
                                
                                $('#display-data').empty();
                                $('.spinner-border').remove()
                                $('#submit_form').css('visibility', 'visible')

                                if(response.length > 0 ) {
                                    $.each(response, function(index, item) {
                                        if(item.image){
                                            $('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-5">\n\
                                                <a href="../invitation/more/'+ item.id +'">\n\
                                                    <div class="card h-100 cardStyle">\n\
                                                        <img class="card-img-top" src="../public/storage/plate-photos/'+ item.image +'" style="width: 100%; height: 15vw; object-fit: cover;">\n\
                                                        <div class="card-body" style="bakcground-color: whitesmoke">\n\
                                                            <small class="text-truncate text-uppercase" style="font-size: 15px; font-weight:bold">\n\
                                                                ' + item.menu + '</small>\n\
                                                            <h5>\n\
                                                                <small style="font-size:14px; font-weight:bold">\n\
                                                                    {{__('messages.Price')}} : '+ item.amountToBePaidByGuest +' ' + item.currency + '\n\
                                                                </small>\n\
                                                            </h5>\n\
                                                            <small>\n\
                                                                <img src="public/storage/'+ item.profile_photo_path +'" style="width:25px; height:25px; border-radius:50%"/>\n\
                                                                            {{__('messages.Organized by')}} : ' + item.name + '\n\
                                                            </small>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </a>\n\
                                            </div>').appendTo('#display-data');
                                        }else{
                                            $('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-5">\n\
                                                <a href="../invitation/more/'+ item.id +'">\n\
                                                    <div class="card h-100 cardStyle">\n\
                                                        <img class="card-img-top" src="../public/storage/plate-photos/default.png" style="width: 100%; height: 15vw; object-fit: cover;">\n\
                                                        <div class="card-body" style="bakcground-color: whitesmoke">\n\
                                                            <small class="text-truncate text-uppercase" style="font-size: 15px; font-weight:bold">\n\
                                                                ' + item.menu + '</small>\n\
                                                            <h5>\n\
                                                                <small style="font-size:14px; font-weight:bold">\n\
                                                                    {{__('messages.Price')}} : '+ item.amountToBePaidByGuest +' ' + item.currency + '\n\
                                                                </small>\n\
                                                            </h5>\n\
                                                            <small>\n\
                                                                <img src="public/storage/'+ item.profile_photo_path +'" style="width:25px; height:25px; border-radius:50%"/>\n\
                                                                            {{__('messages.Organized by')}} : ' + item.name + '\n\
                                                            </small>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </a>\n\
                                            </div>').appendTo('#display-data');
                                        }
                                    })
                                } else {
                                    $('<div class="col-md-12 text-center">\n\
                                        <h4 style="font-size: 28px">{{__('messages.Sorry.')}}</br>{{__('messages.No item matches your search...')}}</h4>\n\
                                        </div>\n\
                                    ').appendTo('#display-data')
                                }
			    			}
			    	});			    		
		    	});
		    });   	
		</script> 
	@endsection
    
</x-app-layout>


