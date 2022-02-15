<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('List roles') }}
        </h2> 
        @include('flash::message')
        <div class="row"> 
            <div class="col-lg-12"> 
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        @can('add-role')
                        <a class="btn btn-success btn-sm float-right" href="{{ route('roles.create') }}" role="button" data-toggle="tooltip">
                            Add new <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @include('roles.table')
                    </div>
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-app-layout>


