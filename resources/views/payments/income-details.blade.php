<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary float-left">
                        <th class="text-center"></th>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('messages.Payment description')}}</th>
                                    <th>{{__('messages.Reference number')}}</th>
                                    <th>{{__('messages.Payment Status')}}</th>
                                    <th>Date</th>
                                    <th class="text-center">{{__('messages.Amount')}}</th> 
                                    <th class="text-center">Client</th>                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($income as $pay)
                                <tr>
                                    <td><small>{{$pay->transaction_type}}</small></td>
                                    <td><small>{{$pay->vendor_payment_id}}</small></td>
                                    <td><small>{{$pay->status}}</small></td>
                                    <td><small>{{$pay->created_at}}</small></td>
                                    <td class="text-center">
                                        <small>{{$pay->amountToBePaidToTheHost}} {{$pay->currency}}</small>
                                    </td>
                                    <td class="text-center"><small>{{$pay->name}} {{$pay->first_name}}</small></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            
            <div class="row">
                <div class="col-lg-6 col-md-6"></div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <section class="content" >
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 text-primary float-left">
                                    <th class="text-center">{{__('messages.Tips')}}</th>
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped projects">
                                    <tbody>
                                        @foreach($tip as $pay)
                                        <tr>
                                            <td><small>{{$pay->vendor_payment_id}}</small></td>
                                            <td><small>{{$pay->created_at}}</small></td>
                                            <td><small>{{$pay->amount}} {{$pay->currency}}</small></td>
                                            <td class="text-center"><small>{{$pay->name}} {{$pay->first_name}}</small></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>