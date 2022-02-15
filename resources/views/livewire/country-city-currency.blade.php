<div>
    <div class="row">
        <!-- Menu Field -->
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('menu', 'Menu: *') !!}
                {!! Form::text('menu', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
            </div>
        </div>
        <!-- Type Of Cuisine Field -->
        <div class="col-md-6">
            <div class="form-group"> 
                {!! Form::label('type_of_cuisine', 'Type of Cuisine: *') !!}
                {!! Form::text('type_of_cuisine', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
            </div>
        </div>
    </div>
    <!-- Description Field -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Country Field -->
        <div class="col-md-5">
            <div class="form-group">
                <label class="form-control-label" for="country">Country: *</span></label>
                <select wire:model="selectedCountry" class="form-control" name="country">
                    <option value="" selected>Choose country</option>
                    @foreach($countries as $country)
                        <option value="{{$country}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label class="form-control-label" for="city">City: *</span></label>
                <select wire:model="selectedCity" class="form-control" name="city">
                    <option value="" selected>Choose city</option>
                    @foreach($countries as $country)
                        <option value="{{$country}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-2">        
            <div class="form-group">
                <label class="form-control-label" for="currency">Currency: * </span></label>
                <select class="form-control" name="currency">
                    <option value="" selected>Choose currency</option>
                    @foreach($countries as $country)
                        <option value="{{$country}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('price', 'Price: *') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('number_of_guests', 'Number of guests: *') !!}
                {!! Form::text('number_of_guests', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label" for="image">Image: </label>
                <input type="file" id="image" class="form-control" name="image"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-control-label" for="date">Date: *</label>
            <div class="form-group">
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control">
                    <span class="input-group-append">
                        <span class="input-group-text bg-white"><i class="fa fa-calendar"></i></span>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Place Field -->
        <div class="col-md-6">        
            <div class="form-group">
            	{!! Form::label('place', 'Place: *') !!}
                {!! Form::text('place', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
            </div>
        </div>
    </div>

    <!-- Date Field -->
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

</div>


