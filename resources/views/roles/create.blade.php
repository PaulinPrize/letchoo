<x-app-layout>
    <x-slot name="header">
    </x-slot>
        
    <div class="row">

        <div class="col-lg-12 order-lg-1">

            @include('adminlte-templates::common.errors')

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Add')}}</h5>
                </div>

                {!! Form::open(['route' => 'roles.store']) !!}
                    <div class="card-body">

                        <div class="row">
                            @include('roles.fields')
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="font-weight-bold">{{__('messages.List of permissions')}}</p>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($allPermissions as $value)
                            <div class="col-md-3">
                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}<br/>
                                    {{ $value->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('roles.index') }}" class="btn btn-default">{{__('messages.Cancel')}}</a>
                    </div>
                {!! Form::close() !!}
            </div>

            </div>

        </div>

    
</x-app-layout>

