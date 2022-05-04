<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row mb-2">
        <div class="col-sm-6"></div>            
        <div class="col-sm-6">
            <a class="btn btn-default float-right" href="{{ route('permissions.index') }}">{{__('messages.Back')}}</a>
        </div>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('permissions.show_fields')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
