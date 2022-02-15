<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Add table') }}
        </h2>
        <div class="row">

            <div class="col-lg-12 order-lg-1">

                @include('adminlte-templates::common.errors')

                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Open a new table</h5>
                    </div>

                    <form method="POST" action="{{ route('invitation.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('invitations.fields')
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('invitations') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        
    </x-slot>
</x-app-layout>



