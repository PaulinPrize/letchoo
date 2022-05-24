<x-app-layout>
    <x-slot name="header"></x-slot>
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary float-left">{{__('messages.My income')}} 
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('messages.Menu')}}</th>
                                    <th>Date</th>
                                    <th class="text-center">{{__('messages.Guests')}}</th> 
                                    <th class="text-center">Total</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>  
                            <tbody>
                                @foreach($myIncomes as $myIncome)
                                    <tr>
                                        <td>{{$myIncome->menu}}</td>
                                        <td>{{$myIncome->created_at}}</td>
                                        <td class="text-center">{{$myIncome->transactions_count}}/{{$myIncome->number_of_guests}}</td>

                                        @foreach($myIncome->transactions as $t)
                                        <td class="text-center">
                                                                            
                                        </td>
                                        @endforeach
                                       
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm " href="{{ route('income-detail', [$myIncome->id]) }}" target="_blank" role="button" data-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
                <div class="card-footer">
                        
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout> 