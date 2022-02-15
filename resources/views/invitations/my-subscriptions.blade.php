<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('My invitations') }}
        </h2> 
        @include('flash::message')
        <div class="row"> 
            <div class="col-lg-12"> 
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        
                    </div>
                    <div class="card-body">
                        @include('invitations.subscription')
                    </div> 
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-app-layout> 


