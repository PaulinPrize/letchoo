<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>{{__('messages.Menu')}}</th>
                <th>{{__('messages.Type of cuisine')}}</th>
                <th>{{__('messages.Guests')}}</th>
                <th class="text-center">{{__('messages.Price')}}</th>
                <th>Date</th>
                <th class="text-center">{{__('messages.Active')}}</th>
                <th class="text-center"></th>
                <th colspan="4" style="text-align:center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invitations as $invitation)
                <tr>
                    <td>{{ $invitation->menu }}</td>
                    <td>{{ $invitation->type_of_cuisine }}</td>
                    <td class="text-center">{{$invitation->transactions_count}}/{{ $invitation->number_of_guests }}</td>
                    <td class="text-center">{{ $invitation->price }} {{ $invitation->currency }} </td>
                    <td>
                        {{ $invitation->date }} {{ date('H:i', strtotime($invitation->heure));}}
                    </td>

                    <td class="text-center">
                        @if($invitation->active)
                        	<label class="badge badge-success">{{__('messages.YES')}}</label>
                        @else
                        	<label class="badge badge-danger">{{__('messages.NO')}}</label>
                        @endif
                    </td>

                    @if($invitation->active == 1)
                        <td class="text-center">
                            @if($invitation->complete == 1)
                                <label class="badge badge-danger">{{__('messages.CLOSED')}}</label>
                            @elseif($invitation->complete == 0)
                                <label class="badge badge-success">{{__('messages.OPENED')}}</label>
                            @endif
                        </td>
                    @endif

                    @can('show-invitation')
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm " href="{{ route('invitation.show', [$invitation->id]) }}" target="_blank" role="button" data-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    @endcan

                    @can('edit-invitation')
                        <td class="text-center">
                            <a href="{{ route('invitation.edit', [$invitation->id]) }}" class='btn btn-warning btn-sm'>
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    @endcan

                    <td class="text-center">
                        <form action="{{route('invitation.destroy', $invitation->id)}} " method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" >
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>

                    @can('show-invitation')

                    @if($invitation->direct_payment == 0)
                        <td class="text-center">
                            <a class="btn btn-success btn-sm " href="{{ route('invitation.subscribers', [$invitation->id]) }}" role="button" data-toggle="tooltip">
                                <i class="fas fa-users"></i>
                            </a>
                        </td>
                    @else
                        <td class="text-center"></td>
                    @endif

                    @endcan
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
