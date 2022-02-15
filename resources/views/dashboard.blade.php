<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Quick access
        </h2>
        <div class="row mb-3">
            @can('add-invitation')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner" style="height: 120px;"></div>
                    <div class="icon">
                        <i class="fas fa-glass-cheers"></i>
                    </div>
                    <a href="{{route('invitation.create')}}" class="small-box-footer">Open new table <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan
            @can('find-invitation')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gray">
                    <div class="inner" style="height: 120px;"></div>
                    <div class="icon">
                        <i class="fas fa-glass-cheers"></i>
                    </div>
                    <a href="{{route('invitations.active')}}" class="small-box-footer">Find a table <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan
            @can('my-payments')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner" style="height: 120px;"></div>
                    <div class="icon">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <a href="{{route('payments.my-payments')}}" class="small-box-footer">My payments <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan
            @can('my-income')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner" style="height: 120px;"></div>
                    <div class="icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <a href="{{route('payments.my-income')}}" class="small-box-footer">My income <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jauge bonus</h3>
                    </div>
                    <div class="card-body">
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                       aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="row">
            <div class="col-lg-12">
                
                <div class="row mb-3">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-envelope-open-text"></i>
                            </span>
                            <div class="info-box-content text-center">
                                <span class="info-box-number">countTables</span>
                                <span class="info-box-text">Open table(s)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1">
                                <i class="fas fa-users"></i>
                            </span>
                            <div class="info-box-content text-center">
                                <span class="info-box-number"></span>
                                <span class="info-box-text">Participant(s)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <div class="info-box-content text-center">
                                <span class="info-box-number">countSubscriptions</span>
                                <span class="info-box-text">Invitation(s)</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="info-box bg-gradient-info">
                            <span class="info-box-icon">
                                <i class="fas fa-trophy"></i>
                            </span>
                            <div class="info-box-content"> 
                                <span class="info-box-text">Bonus</span>
                                <span class="info-box-number"></span>
                                <div class="progress">
                                    <div class="progress-bar w-0"></div>
                                </div>
                                <span class="progress-description">
                                    0% 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        -->
        <!--
        <div class="row">
            
            @if(Auth::user()->user_has_role === 0)
                <div class="col-lg-12 ">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-center" style="font-size:40px;">Welcome !</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <p class="text-center" style="font-size:20px; line-height: 25px;">Thank you for choosing Le Tchoo! You can now use all of our services. <br/>Don't wait any longer.</p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <a href="{{ route('invitation.create') }}" class="btn btn-primary btn-md" role="button" aria-pressed="true">CREATE A TABLE</a>
                            <a href="#" class="btn btn-secondary btn-md" role="button" aria-pressed="true">FIND A TABLE</a>
                        </div>
                    </div>
                    
                </div>
                
            @else
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1">
                                    <i class="fas fa-envelope-open-text"></i>
                                </span>
                                <div class="info-box-content text-center">
                                    <span class="info-box-number">countTables</span>
                                    <span class="info-box-text">Open table(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="info-box-content text-center">
                                    <span class="info-box-number"></span>
                                    <span class="info-box-text">Participant(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning elevation-1">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <div class="info-box-content text-center">
                                    <span class="info-box-number">countSubscriptions</span>
                                    <span class="info-box-text">Invitation(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="info-box bg-gradient-info">
                                <span class="info-box-icon">
                                    <i class="fas fa-trophy"></i>
                                </span>
                                <div class="info-box-content"> 
                                    <span class="info-box-text">Bonus</span>
                                    <span class="info-box-number"></span>
                                    <div class="progress">
                                        <div class="progress-bar w-0"></div>
                                    </div>
                                    <span class="progress-description">
                                        0% 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        -->
    </x-slot>
</x-app-layout>  