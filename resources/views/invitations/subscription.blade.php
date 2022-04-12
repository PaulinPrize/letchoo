<div class="table-responsive">
    <table class="table table-striped projets">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Type of cuisine</th>
                <th class="text-center">Price</th>
                <th class="text-center">Paid</th>
                <th>Event date</th>
                <th>Subscription date</th>
                <th class="text-center">Table status</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($a as $aa)
                <tr>
                    <td>{{ $aa->menu }}</td>
                    <td>{{ $aa->type_of_cuisine }}</td>
                    <td class="text-center">{{($aa->price+($aa->price*$aa->tax)/100)+(($aa->price*10)/100)}} {{$aa->currency}}</td>
                    <td class="text-center">
                        @if($aa->invoice_paid === 0)
                            <label class="badge badge-danger">No</label>
                        @else
                            <label class="badge badge-success">Yes</label>
                        @endif
                    </td>
                    <td>{{ $aa->date }}</td>
                    <td>{{ $aa->created_at }}</td>
                    <td class="text-center">
                        @if($aa->complete)
                            <label class="badge badge-danger">Close</label>
                        @else
                            <label class="badge badge-success">Open</label>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($aa->complete === 1 || $aa->invoice_paid === 1)
                            
                        @elseif($aa->complete === 0 && $aa->activeUser === 0)
                            <label class="badge badge-warning">Subscription under validation</label>
                        @elseif($aa->complete === 0 && $aa->activeUser === 1 && $aa->invoice_paid === 0)
                            <!--
                            <a 
                                class="btn btn-primary btn-sm " 
                                href="{{route('invitation.my-invitations-show', [$aa->id, ($aa->price+($aa->price*$aa->tax)/100)+(($aa->price*5)/100), $aa->currency])}}" 
                                role="button" 
                                data-toggle="tooltip"
                            >
                                Paypal
                            </a>
                            -->
                            <a 
                                class="btn btn-primary btn-sm " 
                                href="{{ route('invitation.subscribe', $aa->id) }}" 
                                role="button" 
                                data-toggle="tooltip"
                            >
                                Paypal
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


