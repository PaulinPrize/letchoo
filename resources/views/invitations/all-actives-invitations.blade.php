<x-app-layout>
<<<<<<< HEAD
=======

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
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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

<<<<<<< HEAD
                            <div class="row">
=======
                            <!-- <div class="row">
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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
<<<<<<< HEAD
                            </div>

                            <div class="row">
=======
                            </div> -->

                           <div class="row">
                                <div class="col-lg-6">
                                    <div class="autocomplete">
                                        <input 
                                            class="form-control" 
                                            type="text" 
                                            autocomplete="off"
                                            id="myAutoComplete"
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="content-spinner">
                                        <button class="btn btn-outline-secondary btn-block" id="submit_form">{{ __('Search') }}
                                        </button>
                                    </div>
                                </div>
                           </div>

                           <!--  <div class="row">
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <select class="form-control form-control-lg" name="type_of_cuisine" id="type_of_cuisine">
                                        <option selected>Choose type of cuisine</option>
                                        @foreach($invit as $i)
                                        <option value="{{$i->type_of_cuisine}}">{{$i->type_of_cuisine}}</option>
                                        @endforeach
                                    </select>
                                </div>
<<<<<<< HEAD
                            </div>

                            <div class="row">
=======
                            </div> -->

                            <!-- <div class="row">
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
                                <div class="col" id="content-spinner">
                                    <button class="btn btn-outline-secondary btn-block" id="submit_form">{{ __('Search') }}
                                    </button>
                                </div>
<<<<<<< HEAD
                            </div>
=======
                            </div> -->
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4

                        </div>
                    </div>

                    <div class="row mt-5 p-3 " id="display-data"></div>

                </div>
                <div class="card-footer"></div>
            </div>
        </div> 
    </div>  

    @section('scripts')
<<<<<<< HEAD
        <script src="{{ asset('public/js/Xhttp_ActiveX.js') }}"></script>
		  <script type="text/javascript">
=======
		<script src="{{ asset('public/js/bootstrap-autocomplete.min.js') }}"></script>
          <script type="text/javascript">

            let near_cities = {!! json_encode($user_cities->toArray()) !!};
            let content_city_id = 0;

>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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
<<<<<<< HEAD
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
=======

                                    $.each(response, function(index, item) {
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
                                    })
                                
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
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
<<<<<<< HEAD
=======

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
                //console.log('cities', cities)
                /*initiate the autocomplete function on the "myAutoComplete" element, and pass along the countries array as possible autocomplete values:*/
                autocomplete(document.getElementById("myAutoComplete"), cities, near_cities);
            }
        };
        xhttp.open("GET", "../cities");
        xhttp.send();

>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
		</script> 
	@endsection
    
</x-app-layout>


