<x-app-layout>
    <x-slot name="header">

    </x-slot>
    
    <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
            <a class="btn btn-default float-right" href="{{ route('users') }}">{{__('messages.Back')}}</a>
        </div>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <p>
                        {{__('messages.Name')}} : {{ $user->name }}<br/>
                        {{__('messages.Role')}} : 
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout> 

