<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('List all the tables') }}
        </h2> 
        
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
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        	<table class="table table-striped table-bordered">
                        		<thead>
						            <tr>
						                <th>Menu</th>
						                <th>Type of cuisine</th>
						                <th class="text-center">Guests</th>
						                <th class="text-center">Price</th>
						    
						        
						                <th>Date</th> 

						                @can('active-invitation')
						                    <th class="text-center">Active</th>
						                @endcan

						                <th colspan="4" style="text-align:center">Action</th>
						            </tr>
						        </thead>
						        <tbody>
							        @foreach($invitations as $invitation)
							            <tr>
							                <td>{{ $invitation->menu }}</td>
							                <td>{{ $invitation->type_of_cuisine }}</td>
							                <td class="text-center">{{ $invitation->number_of_guests }}</td>
							                <td class="text-center">{{ $invitation->price }} {{ $invitation->currency }}</td>
							                <td>{{ $invitation->date }} {{ date('H:i', strtotime($invitation->heure));}}</td>

							                @can('active-invitation')
							                    <td class="text-center">
							                        <input 
							                        	content="{{ $invitation->id }}"
								                        type="checkbox"
								                        name="toggle"
								                        {{ $invitation->active ? 'checked' : '' }}
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
						                        <td class="text-center">
						                            <a class="btn btn-success btn-sm " href="{{ route('invitation.subscribers', [$invitation->id]) }}" role="button" data-toggle="tooltip">
						                                <i class="fas fa-users"></i>
						                            </a>
						                        </td>
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
      	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
			$(function() {
			    $('[name="toggle"]').each(function() {
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
		  	})
        </script>
    </x-slot>
</x-app-layout> 
