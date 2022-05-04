<x-app-layout>
    <x-slot name="header"></x-slot>
        
    @include('flash::message')
    <div class="row"> 
        <div class="col-lg-12"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary float-left">
                        {{__('messages.Roles')}}
                    </h5>
                    @can('add-role')
                    <a class="btn btn-success btn-sm float-right" href="{{ route('roles.create') }}" role="button" data-toggle="tooltip">
                        {{__('messages.Add')}} <i class="fas fa-plus"></i>
                    </a>
                    @endcan
                </div>
                <div class="card-body">
                    @include('roles.table')
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</x-app-layout>


