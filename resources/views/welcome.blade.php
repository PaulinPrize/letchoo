@extends('layouts/accueil')

@section('styles')
    <style>
        
        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            
        }
        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
            overflow-y: scroll;
            max-height: 150px
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff; 
            border-bottom: 1px solid #d4d4d4; 
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9; 
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important; 
            color: #ffffff; 
        }
    </style>
@endsection

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
                                
                                <div class="col-lg-9 col-md-9 col-sm-12 p-0">
                                    <div class="autocomplete">
                                        <input 
                                            class="form-control" 
                                            type="text"
                                            autocomplete="off"
                                            id="myAutoComplete"
                                            placeholder="Recherchez une ville"
                                        >
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <button type="button" class="btn btn-primary wrn-btn" id="submit_form">{{ __('messages.Search') }}</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row" style="display:none">
                        <div class="col-md-12">
                        
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <select class="form-control search-slt" id="country_id" name="country">
                                        <option value="" selected>{{__('messages.Choose country')}}</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->nom}}">{{$country->nom}}</option>
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
                                    <input type="hidden" value="{{ __('messages.Search') }}" id="before-search" >
                                    <input type="hidden" value="{{ __('messages.Searching') }}" id="searching" >
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

                            <div class="row" id="display-data1"></div>

                        </div>
                    </div>

                    <div class="row" id="display-data2"></div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        let near_cities = {!! json_encode($user_cities->toArray()) !!};
        let content_city_id = 0;
        $(document).ready(function () {
            
            $('#country_id').change(function() {
                // Récupérer le pays sélectionné
                var city = $(this).val();
                $('#city_id').empty();
                $.ajax({
                    url: "./villes/"+city,
                    success: function(data) {
                        $.each(data.villes, function(value1, value2){
                            $('<option value="' + value2 + '">' + value2 + '</option>').appendTo('#city_id');
                        });
                    }
                });
            });

            $("#submit_form").on("click", function() {
                $(this).prop('disabled', true)
                $(this).text($('#searching').val())
                var data ={
                    //'country': $("#country_id").val(),
                    //'city': content_city_id,
                    'city': $('#myAutoComplete').val(),
                    //'type_of_cuisine': $("#type_of_cuisine").val(),
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
                                if(item.image){
                                    $(' <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">\n\
                                        <a href="./invitation/more/'+ item.id +'">\n\
                                            <div class="card h-100 cardStyle">\n\
                                                <img class="card-img-top" src="public/storage/plate-photos/'+ item.image +'" style="width: 100%; height: 15vw; object-fit: cover;">\n\
                                                <div class="card-body">\n\
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
                                        </div>\n\
                                    ').appendTo('#display-data1');
                                }else{
                                    $(' <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">\n\
                                        <a href="./invitation/more/'+ item.id +'">\n\
                                            <div class="card h-100 cardStyle">\n\
                                                <img class="card-img-top" src="public/storage/plate-photos/default.png" style="width: 100%; height: 15vw; object-fit: cover;">\n\
                                                <div class="card-body">\n\
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
                                        </div>\n\
                                    ').appendTo('#display-data1');
                                }
                            })
                        }else{
                            $('<div class="col-md-12 text-center"><h4 style="font-size: 28px">{{__('messages.Sorry.')}}</br>{{__('messages.No item matches your search...')}}</h4></div>').appendTo('#display-data2')
                        }
                    }
                });

                $(this).prop('disabled', false)
                setTimeout(() =>{
                    $(this).text($('#before-search').val())
                }, 1000);
            });
            
            
        });
   

        function autocomplete(inp, arr, cities) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function focus*/
            if(cities.length > 0) {
                inp.addEventListener("click", function(e) {
                    if(this.value != "") return;
                    var a, b, i;
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-liste");
                    a.setAttribute("class", "autocomplete-items");
                    this.parentNode.appendChild(a);

                    for (i = 0; i < cities.length; i++) {
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + cities[i].nom + "</strong>";
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + cities[i].nom + "' content_id='" + cities[i].id + "' id='content"+i+ "' >";
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            //console.log("value", e.target.lastChild.value)
                            inp.value = e.target.lastChild.value;
                            content_city_id = e.target.lastChild.value
                            
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                });
            }
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) { return false;}
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].name.substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i].name + "' content_id='" + arr[i].id + "' id='the_city_id'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            content_city_id = inp.value
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                    }
                }
            });
            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }
            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }
            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });

        }

        /*An array containing all the country names in the world:*/
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let info = this.responseText;
                let cities = eval('('+info+')') ;
                autocomplete(document.getElementById("myAutoComplete"), cities, near_cities);
            }
        };
        xhttp.open("GET", "cities");
        xhttp.send();

        /*initiate the autocomplete function on the "myAutoComplete" element, and pass along the countries array as possible autocomplete values:*/
        

    </script>
@endsection
