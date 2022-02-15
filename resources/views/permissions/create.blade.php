<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Add permission') }}
        </h2>
        <div class="row">

            <div class="col-lg-12 order-lg-1">

                @include('adminlte-templates::common.errors')

                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Add a new permission</h5>
                    </div>

                    {!! Form::open(['route' => 'permissions.store']) !!}
                    <div class="card-body">
                        <div class="row">
                            @include('permissions.fields')
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('permissions.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>

        </div>

    </x-slot>
</x-app-layout>

