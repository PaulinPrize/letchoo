<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('List users') }}
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
                    	<h5 class="m-0 font-weight-bold text-primary float-left">Users ({{ $widget['users'] }})</h5>
                    	@can('add-user')
                    	<a class="btn btn-success btn-sm float-right" href="{{ route('user.create') }}" role="button" data-toggle="tooltip">
	                        Add new <i class="fas fa-plus"></i>
	                    </a>
	                    @endcan
                	</div>
                	<div class="card-body">
                		<div class="table-responsive">
                			<table class="table table-striped table-bordered">
	                			<thead class="">
	                				<tr>
	                    				<th>Name</th>   
	                    				<th>Email</th>
	                    				<th>Phone</th>
	                    				<th>Role</th>
	                    				<!--
	                    				<th>Dernière connexion</th>  
	                    				-->
	                    				<th colspan="3" style="text-align:center">Actions</th>
	                				</tr>
	            				</thead>
            					<tbody>
	            					@foreach($utilisateurs as $utilisateur)
	            						<tr @if($utilisateur->deleted_at) @endif>
	            							<td>{{$utilisateur->name}}</td>
	            							<td>{{$utilisateur->email}}</td>
	            							<td>{{$utilisateur->telephone}}</td>
	            							<td>
      											@if(!empty($utilisateur->getRoleNames()))
        											@foreach($utilisateur->getRoleNames() as $v)
           												<label class="badge badge-success">{{ $v }}</label>
        											@endforeach
      											@endif
    										</td>
	            							<!--
	            							<td>{{$utilisateur->last_seen}}</td>
	            							-->
	            							@can('show-user')
	            							<td class="text-center">
	                                            @if($utilisateur->deleted_at)
	                                                <form action="{{ route('user.restore', $utilisateur->id) }}" method="post">
	                                                    @csrf
	                                                    @method('PUT')
	                                                    <button class="btn btn-danger btn-sm" type="submit" title="Restaurer">
	                                                        <i class="fas fa-undo"></i>
	                                                    </button>
	                                                </form>
	                                            @else
	            								    <a class="btn btn-primary btn-sm " href="{{ route('user.show', $utilisateur->id) }}" target="_blank" role="button" data-toggle="tooltip">
	                                				    <i class="fas fa-eye"></i>
	                            				    </a>
	                                            @endif
	            							</td>
	            							@endcan

	            							@can('delete-user')
	            							<td class="text-center">
	            								<form action="{{route($utilisateur->deleted_at? 'user.force.destroy' : 'user.destroy', $utilisateur->id)}} " method="post">
	                                        		@csrf
	                                        		@method('DELETE')
	                                        		<button class="btn btn-danger btn-sm" type="submit" >
	                                        			<i class="fas fa-trash"></i>
	                                        		</button>
	                                    		</form>
	            							</td>
	            							@endcan

	            						</tr>
	            					@endforeach
            					</tbody>
                			</table>
                		</div>
                	</div>
        			<div class="card-footer d-flex align-items-center justify-content-center">
                        {{ $utilisateurs->links() }}
                    </div>
				</div>
			</div>
		</div>
    </x-slot>
</x-app-layout>