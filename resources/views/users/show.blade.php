<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Show user') }}
                </h2>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-default float-right" href="{{ route('user') }}">Back</a>
            </div>
        </div>

        <div class="content px-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <p>
                            Nom : {{ $user->name }}<br/>
                            Role : 
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
    </x-slot>
</x-app-layout> 

