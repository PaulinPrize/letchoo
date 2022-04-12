@extends('layouts/accueil')
<div class="container-fluid" style="border:1px solid #882E57; margin-top:114px;">
    <div class="row align-items-center" style="background-color: #882E57 ; height: 550px; ">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <p style="text-align:center; color:white; font-size: 27px">Envie de faire voyager vos papilles ?</p>
            <div class="row">
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
                        <div class="col" id="content-spinner">
                            <button class="btn btn-outline-secondary btn-block" id="submit_form">{{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('content') 
    <div class="row p-3 d-none lasection">
        <div class="col-lg-12">
            <div class="row justify-content-center" id="display-data" style="padding: 20px;"></div>
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

               // add spinner. hide button and display spinner
               $('<div class="row justify-content-center"><div class="spinner-border" style="color: #6c757d">\n\
                                <span class="sr-only">Chargement...</span>\n\
                </div></div>').appendTo('#content-spinner');

                $(this).css('visibility', 'hidden');

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

                        $('.spinner-border').remove()
                        $('#submit_form').css('visibility', 'visible')
                        $('.lasection').removeClass('d-none');
                        $('#display-data').empty();

                        if(response.length > 0 ) {

                            $.each(response, function(index, item) {
                                $('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 30px;">\n\
                                    <div class="card h-100 shadow">\n\
                                        <a href="./invitation/more/'+ item.id +'">\n\
                                            <img class="card-img-top" src="public/storage/plate-photos/'+ item.image +'" style="width: 100%; height: 20vw; object-fit: cover;">\n\
                                        </a>\n\
                                        <div class="card-body">\n\
                                            <p class="text-center text-uppercase text-truncate">\n\
                                                <a href="./invitation/more/'+ item.id +'">\n\
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
                                                <img src="public/storage/'+ item.profile_photo_path +'" style="width:25px; height:25px; border-radius:50%"/>\n\
                                                            Posted by : ' + item.name + '\n\
                                            </small>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>').appendTo('#display-data');
                            })

                        }else {

                            $('<p class="font-weight-light text-center" id="no-found" style="font-size: 26px">Désolé.</br>Aucun element ne correspond à votre recherche.</p>').appendTo('#display-data')
                        }
                    }
                });
            });
        });
    </script> 
@endsection