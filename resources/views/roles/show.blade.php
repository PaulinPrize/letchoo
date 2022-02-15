<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Show role') }}
                </h2>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-default float-right" href="{{ route('roles.index') }}">Back</a>
            </div>
        </div>

        <div class="content px-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('roles.show_fields')
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permissions:</strong>
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <label class="label label-success">{{ $v->name }},</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>  

