<x-app-layout>
    <x-slot name="header"></x-slot>
        
    <div class="row">
        <div class="col-lg-12 order-lg-1">

            @include('adminlte-templates::common.errors')

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Edit')}}</h5>
                </div>

                {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}

                    <div class="card-body">
                        <div class="row">
                            @include('roles.fields')
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{__('messages.Permissions')}} :</strong>
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                        {{ $value->name }}</label>
                                        <br/>
                                    @endforeach
                                </div>
                            </div>
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
