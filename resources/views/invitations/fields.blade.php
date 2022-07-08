<div class="row">
    <div class="col-md-6">
        <div class="form-group focused">
            <label class="form-control-label" for="menu">Menu: * </label>
            {!! Form::text('menu', null, ['class' => 'form-control','maxlength' => 255, 'name' => 'menu']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="type_of_cuisine">{{__('messages.Type of cuisine')}}: *</label>
            <select class="form-control" id="type_of_cuisine" name="type_of_cuisine">
                <option value="" selected>{{__('messages.Choose type of cuisine')}}</option>
<<<<<<< HEAD
                @foreach($pays as $p)
                <option {{ old('type_of_cuisine') == $p ? "selected" : "" }} value="{{ $p }}">
                    {{ $p }}
                </option>
=======
                @foreach($countries as $country)
                <option value="{{$country->nom}}">{{$country->nom}}</option>
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group focused">
            <label class="form-control-label" for="description">Description: </label>
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="country">{{__('messages.Choose country')}} *</label>
            <select class="form-control" id="country_id" name="country">
                <option value="" selected>{{__('messages.Choose country')}}</option>
                @foreach($countries as $country)
<<<<<<< HEAD
                <option {{ old('country') == $country->nom ? "selected" : "" }} value="{{ $country->nom }}">
                    {{ $country->nom }}
                </option>
=======
                    <option value="{{$country->nom}}">{{$country->nom}}</option>
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6" id="city">
        <div class="form-group">
            <label class="form-control-label" for="city">{{__('messages.Choose city')}} *</label>
            <select class="form-control" id="city_id" name="city">
               <option value="" selected>{{__('messages.Choose city')}}</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 d-none" id="currency">        
        <div class="form-group">
            <label class="form-control-label" for="currency">Currency *</label>
            <input type="text" id="currency_id" class="form-control" name="currency"/>
        </div>
    </div>
    <div class="col-md-6 d-none" id="tax">        
        <div class="form-group">
            <label class="form-control-label" for="tax">TVA *</label>
            <input type="text" id="tax_id" class="form-control" name="tax"/>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">        
        <div class="form-group focused">
            <label for="place">{{__('messages.Place')}}: *</label>
            {!! Form::text('place', null, ['class' => 'form-control','maxlength' => 255, 'name' => 'place']) !!}
            <small class="form-text text-muted">ex : 27 rue Jean Goujon</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group focused">
            <label for="price">{{__('messages.Price')}}: *</label>
            {!! Form::text('price', null, ['class' => 'form-control','maxlength' => 255, 'name' => 'price']) !!}
            <small class="form-text text-muted">ex : 200</small>
       </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group focused">
            <label for="date">Date : *</label>
            {!! Form::date('date', null, ['class' => 'form-control','name' => 'date']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="heure">Time : </label>
<<<<<<< HEAD
            {!! Form::time('heure', null, ['class' => 'form-control','name' => 'heure']) !!}
=======
            <input type="time" class="form-control" name="heure"/>
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('number_of_guests', 'Number of guests: *') !!}
            {!! Form::text('number_of_guests', null, ['class' => 'form-control', 'name' => 'number_of_guests']) !!}
            <small class="form-text text-muted">ex : 5</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="image">Image : </label>
            <input type="file" id="image" class="form-control" name="image"/>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-check">
                {!! Form::hidden('direct_payment', 0, ['class' => 'form-check-input']) !!}
                {!! Form::checkbox('direct_payment', '1', null, ['class' => 'form-check-input']) !!}
                {!! Form::label('direct_payment', 'Check this box to allow guests to pay directly.', ['class' => 'form-check-label']) !!}
            </div>
        </div>
    </div>
</div>
<!--
<div class="row mt-3">
    <div class="col-md-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="ok" required>
            <label class="custom-control-label" for="ok">I accept the <a href="#">terms and conditions</a> of the privacy policy</label>
        </div>
    </div>
</div>
-->
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" id="user_id" class="form-control" name="user_id" value="{{$user}}" hidden>
        </div>
    </div>
    <!-- Active Field 
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-check">
                {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
                {!! Form::checkbox('active', '1', null, ['class' => 'form-check-input']) !!}
                {!! Form::label('active', 'Active', ['class' => 'form-check-label']) !!}
            </div>
        </div>
    </div>
    -->
</div>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#country_id').change(function(){
                // Récupérer le nom du pays sélectionné
                var name = $(this).val();

                //$('#city').removeClass('d-none');
                $('#city_id').empty();
                
                //$('#currency').removeClass('d-none');
                $('#currency_id').empty();

                //$('#tax').removeClass('d-none');
                $('#tax_id').empty();

                $.ajax({
                    url: "./../country/"+name,
                    
                    success: function(data) {
                        $.each(data.villes, function(value1, value2){
                            $('#city_id').append('<option value="' + value2 + '">' + value2 + '</option>');
                        });
                        $('#currency_id').val(data.currency);
                        $('#tax_id').val(data.tax);
                    }
                });
            });
        });
    </script>
    
@endsection
