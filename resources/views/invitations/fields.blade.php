<!--
<div class="row">
    <div class="col-lg-12">
        <div class="alert" role="alert" style="background-color: #7b1745; color:white">
            <i class="fas fa-exclamation-triangle"></i> LeTchoo will take 15% of your total turnover for this table.
        </div>
    </div>
</div>
-->
<div class="row">
    <!-- Menu Field -->
    <div class="col-md-6">
        <div class="form-group focused">
            <label class="form-control-label" for="menu">Menu: * </label>
            <input type="text" id="menu" class="form-control" name="menu" value="{{ old('menu', '') }}" maxlength=255/>
        </div>
    </div>
    <!-- Type Of Cuisine Field 
    <div class="col-md-6">
        <div class="form-group"> 
            {!! Form::label('type_of_cuisine', 'Type of Cuisine: *') !!}
            {!! Form::text('type_of_cuisine', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
        </div>
    </div>
    -->
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="type_of_cuisine">{{__('messages.Type of cuisine')}}: *</label>
            <select class="form-control" id="type_of_cuisine" name="type_of_cuisine">
                <option value="" selected>{{__('messages.Choose type of cuisine')}}</option>
                @foreach($countries as $country)
                    <option value="{{$country->nom}}">{{$country->nom}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<!-- Description Field -->
<div class="row">
    <div class="col-md-12">
        <div class="form-group focused">
            <label class="form-control-label" for="description">Description: </label>
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            <!--
            <textarea id="description" class="form-control" name="description" rows="4" cols="4">
                {{{ old('description') }}}
            </textarea>    
            -->
        </div>
    </div>
</div>
<div class="row">
    <!--
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label" for="country">Choose country *</label>
            <select class="form-control" id="country_id" name="country">
                <option value="" selected>Choose country</option>
                @foreach($allCountries as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
        </div>
    </div>
    -->
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label" for="country">{{__('messages.Choose country')}} *</label>
            <select class="form-control" id="country_id" name="country">
                <option value="" selected>{{__('messages.Choose country')}}</option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->nom}}</option>
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
            <input type="text" class="form-control" name="place" value="{{ old('place', '') }}" maxlength="255"/>
            <small class="form-text text-muted">ex : 27 rue Jean Goujon</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group focused">
            <label for="price">{{__('messages.Price')}}: *</label>
            <input type="text" class="form-control" name="price" value="{{ old('price', '') }}" maxlength="255"/>
            <small class="form-text text-muted">ex : 200</small>
       </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group focused">
            <label for="date">Date : *</label>
            <input type="date" class="form-control" name="date"/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="heure">Time : </label>
            <input type="time" class="form-control" name="heure"/>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('number_of_guests', 'Number of guests: *') !!}
            <input type="text" class="form-control" name="number_of_guests" value="{{ old('number_of_guests', '') }}"/>
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
<div class="row">
    <div class="col-md-3">        
        <div class="form-group">
            {!! Form::label('postal_code', 'Postal code: ') !!}
            {!! Form::text('postal_code', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
            <small class="form-text text-muted">ex : 75010</small>
        </div>
    </div>
</div>

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
                // Récupérer l'id du pays sélectionné
                var id = $(this).val();

                //$('#city').removeClass('d-none');
                $('#city_id').empty();
                
                //$('#currency').removeClass('d-none');
                $('#currency_id').empty();

                //$('#tax').removeClass('d-none');
                $('#tax_id').empty();

                $.ajax({
                    url: "./../cities/"+id,
                    
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
