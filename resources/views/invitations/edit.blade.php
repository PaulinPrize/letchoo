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
        <div class="form-group">
            <label class="form-control-label" for="country">{{__('messages.Choose country')}} *</label>
            <select class="form-control" id="country_id" name="country">
                <option value="" selected>{{__('messages.Choose country')}}</option>
                @foreach($countries as $country)
                <option {{ old('country') == $country->nom ? "selected" : "" }} value="{{ $country->nom }}">
                    {{ $country->nom }}
                </option>
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


