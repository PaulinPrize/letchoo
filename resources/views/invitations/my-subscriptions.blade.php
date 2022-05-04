<x-app-layout>
    <x-slot name="header"></x-slot>
    @include('flash::message')
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


