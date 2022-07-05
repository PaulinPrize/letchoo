<x-app-layout>
    <x-slot name="header"></x-slot>
        
    <div class="row">

        <div class="col-lg-12 order-lg-1">

            @include('adminlte-templates::common.errors')

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Edit')}}</h5>
                </div>
                {!! Form::model($invitation, ['route' => ['invitation.update', $invitation->id], 'method' => 'put']) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="menu">Menu: * </label>
                                        {!! Form::text('menu', null, ['class' => 'form-control','maxlength' => 255, 'name' => 'menu']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="type_of_cuisine">{{__('messages.Type of cuisine')}}: *</label>
                                        <select class="form-control" id="type_of_cuisine" name="type_of_cuisine">
                                            @foreach($countries as $country)
                                                @if (old('type_of_cuisine') == $country->nom)
                                                    <option value="{{ $country->nom }}" selected>{{ $country->nom }}</option>
                                                    @else
                                                    <option value="{{$country->nom}}">{{$country->nom}}</option>
                                                @endif
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
                                            @foreach($countries as $country)
                                                @if (old('country') === $country->nom)
                                                    <option value="{{ $country->nom }}" selected>{{ $country->nom }}</option>
                                                @else
                                                    <option value="{{$country->nom}}">{{$country->nom}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="city">
                                    <div class="form-group">
                                        <label class="form-control-label" for="city">{{__('messages.Choose city')}} *</label>
                                        <select class="form-control" id="city_id" name="city">
                                            @if(old('city') == $invitation->city)
                                                
                                            @else
                                                <option value="{{ $invitation->city }}" selected>{{ $invitation->city }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 " id="currency">        
                                    <div class="form-group">
                                        <label class="form-control-label" for="currency">Currency *</label>
                                        <input type="text" id="currency_id" class="form-control" name="currency" value="{{old('currency', $invitation->currency)}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6 " id="tax">        
                                    <div class="form-group">
                                        <label class="form-control-label" for="tax">TVA *</label>
                                        <input type="text" id="tax_id" class="form-control" name="tax" value="{{old('tax', $invitation->tax)}}"/>
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
                                        {!! Form::time('heure', null, ['class' => 'form-control','name' => 'heure']) !!}
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
                                        <input type="file" id="image" class="form-control" name="image" />
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

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="user_id" class="form-control" name="user_id" value="{{$user}}" hidden>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('invitation.my-invitations') }}" class="btn btn-default">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>

        </div>

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
</x-app-layout>


