<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('My tables') }}
        </h2> 

        @if(session()->has('info')) 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('info') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="row"> 
            <div class="col-lg-12"> 
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        
                        @can('add-invitation')
                            <a class="btn btn-success btn-sm float-right" href="{{ route('invitation.create') }}" role="button" data-toggle="tooltip">
                                Open new table <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                        
                    </div>
                    <div class="card-body">
                        @include('invitations.table')
                    </div> 
                    <div class="card-footer d-flex align-items-center justify-content-center">
                        {{ $invitations->links() }}
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-app-layout> 


