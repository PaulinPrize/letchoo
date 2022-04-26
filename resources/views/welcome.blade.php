@extends('layouts/accueil')

@section('content')
    <div class="section1">
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">

            <div class="row p-3" style="width: 100%; background-color: #de99c2; border-radius: 5px 5px 5px 5px;">
                <div class="col-md-12">

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4 class="text-center formStyle">
                            {{__('messages.Want to make your taste buds travel ?')}}
                        </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <select class="form-control search-slt" id="country_id" name="country">
                                        <option value="" selected>{{__('messages.Choose country')}}</option>
                                        @foreach($allCountries as $country)
                                        <option value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0" id="city">
                                    <select class="form-control search-slt" id="city_id" name="city">
                                        <option value="">{{__('messages.Choose city')}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <select class="form-control search-slt" name="type_of_cuisine" id="type_of_cuisine">
                                        <option selected>{{__('messages.Choose type of cuisine')}}</option>
                                        @foreach($invit as $inv)
                                        <option value="{{$inv->type_of_cuisine}}">
                                        {{$inv->type_of_cuisine}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <button type="button" class="btn btn-primary wrn-btn" id="submit_form">{{ __('messages.Search') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    
    <div class="section2 d-none" style="border: 1px solid green">
        <div class="container">
            <div class="row p-5" style="style="width: 100%;">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <!--
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="float-left">L</h1>
                                    <h1 class="float-right">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-arrow-left"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </h1>
                                </div>
                            </div>
                            -->

                            <div class="row" id="display-data1">

                            </div>

                        </div>
                    </div>

                    <div class="row" id="display-data2">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#country_id').change(function() {
                // Récupérer le pays sélectionné
                var city = $(this).val();
                $('#city_id').empty();
                $.ajax({
                    url: "./villes/"+city,
                    success: function(data) {
                        //console.log(data.villes)
                        $.each(data.villes, function(value1, value2){
                            $('<option value="' + value2 + '">' + value2 + '</option>').appendTo('#city_id');
                        });
                    }
                });
            });

            $("#submit_form").on("click", function() {


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
                    url: "./searchData",
                    data: data,
                    dataType: "json",

                    success: function(response) {
                        $('#submit_form').css('visibility', 'visible')
                        $('.section2').removeClass('d-none');
                        $('#display-data1').empty();
                        $('#display-data2').empty();

                        if(response.length > 0 ) {
                            $.each(response, function(index, item) {
                                $(' <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">\n\
                                        <a href="./invitation/more/'+ item.id +'">\n\
                                            <div class="card h-100 cardStyle">\n\
                                                <img class="card-img-top" src="public/storage/plate-photos/'+ item.image +'" style="width: 100%; height: 15vw; object-fit: cover;">\n\
                                                <div class="card-body">\n\
                                                    <small class="text-uppercase text-truncate" style="font-size: 15px; font-weight:bold">\n\
                                                        ' + item.menu + '</small>\n\
                                                    <h5>\n\
                                                        <small style="font-size:14px; font-weight:bold">\n\
                                                            {{__('messages.Price')}} : '+ item.total +' ' + item.currency + '\n\
                                                        </small>\n\
                                                    </h5>\n\
                                                    <small>\n\
                                                        <img src="public/storage/'+ item.profile_photo_path +'" style="width:25px; height:25px; border-radius:50%"/>\n\
                                                                    {{__('messages.Organized by')}} : ' + item.name + '\n\
                                                    </small>\n\
                                                </div>\n\
                                            </div>\n\
                                        </a>\n\
                                    </div>\n\
                                ').appendTo('#display-data1');
                            })
                        }else{
                            $('<div class="col-md-12 text-center"><h4 style="font-size: 28px">{{__('messages.Sorry.')}}</br>{{__('messages.No item matches your search...')}}</h4></div>').appendTo('#display-data2')
                        }
                    }
                });


            });
            
            
        });
        /*
            let i;
        for(i=0; i<3; i++){
            const log = () =>{
                console.log(i);
            }
            setTimeout(log, 100);
        }
        */
    </script>
@endsection
