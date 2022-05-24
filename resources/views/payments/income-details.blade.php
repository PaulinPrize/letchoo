<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                	<section class="content" >
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped projects">
                                	<thead>
                                        <tr>
                                            <th>{{__('messages.Reference number')}}</th>
                                            <th>{{__('messages.Payment description')}}</th>
                                            <th>{{__('messages.Payment Status')}}</th>
                                            <th>Date</th>
                                            <th></th>                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($income as $pay)
                                        <tr>
                                            <td><small>{{$pay->vendor_payment_id}}</small></td>
                                            <td><small>{{$pay->transaction_type}}</small></td>
                                            <td><small>{{$pay->status}}</small></td>
                                            <td><small>{{$pay->created_at}}</small></td>
                                            <td><small>{{$pay->amountToBePaidToTheHost}} {{$pay->currency}}</small></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
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