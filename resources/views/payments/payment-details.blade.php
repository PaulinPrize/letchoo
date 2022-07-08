<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary float-left"></h5>   
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">{{__('messages.Payment description')}}</th>
                                    <th>{{__('messages.Reference number')}}</th>
                                    <th class="text-center">{{__('messages.Payment Status')}}</th>
                                    <th>Date</th>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">{{__('messages.Amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($payment as $pay)
                                <tr>
                                    <td class="text-center">{{$pay->transaction_type}}</td>
                                    <td>{{$pay->vendor_payment_id}}</td>
                                    <td class="text-center"><small>{{$pay->status}}</small></td>
                                    <td>{{$pay->created_at}}</td>
                                    <td class="text-center">{{$pay->name}} {{$pay->first_name}}</td>
                                    <td class="text-center">{{$pay->amount}} {{$pay->currency}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"> </span>
                                <h5 class="description-header">{{$totalAmount}} {{$currency}}</h5>
                                <span class="description-text">TOTAL</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-warning"></span>
<<<<<<< HEAD
                                <h5 class="description-header">{{$amountToBePaidToTheHost}} {{$currency}} + {{$tips}} {{$currency}} = {{$hostIncome}} {{$currency}}</h5>
=======
                                <h5 class="description-header">{{$amountToBePaidToTheHost}} + {{$tips}} {{$currency}} = {{$hostIncome}}</h5>
>>>>>>> cd6dbd5213b63ee6b68780f7d29a7cdbce11a9f4
                                <span class="description-text">{{__('messages.Host income')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"></span>
                                <h5 class="description-header">{{$income}} {{$currency}}</h5>
                                <span class="description-text">{{__('messages.Total profit')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span class="description-percentage text-danger"></span>
                                <h5 class="description-header">{{$taxIncome}} {{$currency}}</h5>
                                <span class="description-text">{{__('messages.Tax income')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>