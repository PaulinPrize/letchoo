<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">

        @can('add-invitation')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white">
                <div class="inner" style="height: 120px;"></div>
                <div class="icon">
                    <i class="fas fa-plus"></i>
                </div>
                <a href="{{route('invitation.create')}}" class="small-box-footer">{{__('messages.Open new table')}} 
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endcan

        @can('find-invitation')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white">
                <div class="inner" style="height: 120px;"></div>
                <div class="icon">
                    <i class="fas fa-search"></i>
                </div>
                <a href="{{route('invitations.active')}}" class="small-box-footer">{{__('messages.Find a table')}}
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endcan

        @can('my-payments')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white">
                <div class="inner" style="height: 120px;"></div>
                <div class="icon">
                    <i class="fas fa-money-bill-alt"></i>
                </div>
                <a href="{{route('payments.my-payments')}}" class="small-box-footer">{{__('messages.My payments')}} 
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endcan

        @can('my-income')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white">
                <div class="inner" style="height: 120px;"></div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <a href="{{route('payments.my-income')}}" class="small-box-footer">{{__('messages.My income')}} 
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endcan

    </div>
    <!--
    @can('see-gauge')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('messages.Bonus gauge')}}</h3>
                </div>
                <div class="card-body">
                    <div class="progress">
                        <div 
                            class="progress-bar bg-primary progress-bar-striped" 
                            role="progressbar"
                            aria-valuenow="{{ Auth::user()->discount }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100" 
                            style="width: {{ Auth::user()->discount }}%"
                        >
                            <span class="sr-only">{{ Auth::user()->discount }} {{__('messages.Complete (success)')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    -->

</x-app-layout>