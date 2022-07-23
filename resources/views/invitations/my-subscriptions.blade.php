<x-app-layout>
    <x-slot name="header"></x-slot>
    
    @if(session()->has('information')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('information') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="row"> 
        <div class="col-lg-12"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary float-left">
                        {{__('messages.My subscriptions')}}
                    </h5>
                </div>
                <div class="card-body">
                        @include('invitations.subscription')
                </div> 
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</x-app-layout> 


