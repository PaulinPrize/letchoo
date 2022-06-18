<x-app-layout>
    <x-slot name="header"></x-slot>
  
    @if(session()->has('info')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('info') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row"> 
        <div class="col-lg-12"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                	<h5 class="m-0 font-weight-bold text-primary float-left">
                        {{__('Tables')}}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                        	<thead>
						        <tr>
						            <th>{{__('messages.Menu')}}</th>
						            <th>{{__('messages.Type of cuisine')}}</th>
						            <th class="text-center">{{__('messages.Guests')}}</th>
						            <th class="text-center">{{__('messages.Price')}}</th>
						    		<th>Date</th> 
						            @can('active-invitation')
						            <th class="text-center">{{__('messages.Enable')}}</th>
						            @endcan
						            @can('close-invitation')
                    					<th class="text-center">{{__('messages.Close')}}</th>
                					@endcan
									<th colspan="4" style="text-align:center">Actions</th>
						        </tr>
						    </thead>
						    <tbody>
							    @foreach($invitations as $invitation)
							    <tr>
							        <td>{{ $invitation->menu }}</td>
							        <td>{{ $invitation->type_of_cuisine }}</td>
							        <td class="text-center">{{$invitation->transactions_count}}/{{ $invitation->number_of_guests }}</td>
							        <td class="text-center">{{ $invitation->price }} {{ $invitation->currency }}</td>
							        <td>{{ $invitation->date }} {{ date('H:i', strtotime($invitation->heure));}}</td>
									@can('active-invitation')
							        <td class="text-center">
							            <input 
							             	type="checkbox"
								            name="toggle1"
							             	content="{{ $invitation->id }}"
								            {{ $invitation->active ? 'checked' : '' }}
							            >						             
							        </td>
							        @endcan
							        @can('close-invitation')
			                        <td class="text-center">
			                            <input 
			                                content="{{ $invitation->id }}"
			                                type="checkbox"
			                                name="toggle2"
			                                {{ $invitation->complete ? 'checked' : '' }}
			                            >
			                        </td>
                    				@endcan
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
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    {{ $invitations->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript">
		$(function() {
			$('[name="toggle1"]').each(function() {
			    $(this).change(function(){
			        var status = $(this).prop('checked') == true ? 1 : 0; 
        			var invitation_id = $(this).attr('content'); 
				    $.ajax({
				        type: "GET",
				        dataType: "json",
				        url: "{{route('invitation.changeStatus')}}",
				        data: {'active': status, 'invitation_id': invitation_id},
				        success: function(data){
				            console.log(data)
				        }
				    });
			           
			    })
			});
		
			$('[name="toggle2"]').each(function() {
	            $(this).change(function(){
	                var complete = $(this).prop('checked') == true ? 1 : 0; 
	                var invitation_id = $(this).attr('content'); 
	                $.ajax({
	                    type: "GET",
	                    dataType: "json",
	                    url: "{{route('invitation.close')}}",
	                    data: {'complete': complete, 'invitation_id': invitation_id},
	                    success: function(data){
	                        console.log(data)
	                    }
	                });
	            })
        	});
		})
    </script>
</x-app-layout> 
