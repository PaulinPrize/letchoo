<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Show permission') }}
                </h2>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-default float-right" href="{{ route('permissions.index') }}">Back</a>
            </div>
        </div>

        <div class="content px-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('permissions.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout> 
