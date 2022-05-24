<div class="table-responsive">
    <table class="table table-striped projets">
        <thead>
            <tr>
                <th>{{__('messages.Menu')}}</th>
                <th>{{__('messages.Type of cuisine')}}</th>
                <th class="text-center">{{__('messages.Price')}}</th>
                <th>{{__('messages.Event date')}}</th>
                <th>{{__('messages.Subscription date')}}</th>
                <th class="text-center">{{__('messages.Table status')}}</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($a as $aa)
                <tr>
                    <td>{{ $aa->menu }}</td>
                    <td>{{ $aa->type_of_cuisine }}</td>
                    <td class="text-center">{{$aa->amountToBePaidByGuest}} {{$aa->currency}}</td>
                    <td>{{ $aa->date }}</td>
                    <td>{{ $aa->created_at }}</td>
                    <td class="text-center">
                        @if($aa->complete)
                            <label class="badge badge-danger">{{__('messages.CLOSED')}}</label>
                        @else
                            <label class="badge badge-success">{{__('messages.OPENED')}}</label>
                        @endif
                    </td>
                    <td class="text-center">    
                        @if($aa->complete === 0 && $aa->activeUser === 0)
                            <label class="badge badge-warning">{{__('messages.Subscription under validation')}}</label>
                        @elseif($aa->complete === 0 && $aa->activeUser === 1)
                            <a 
                                class="btn btn-primary btn-sm " 
                                href="{{ route('invitation.subscribe', $aa->invitation_id) }}" 
                                role="button" 
                                data-toggle="tooltip"
                            >
                                <i class="fab fa-paypal"></i> Paypal
                            </a>
                        @else
                        
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


