<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Add user') }}
        </h2>
        <div class="row">

        	<div class="col-lg-12 order-lg-1">

            	<div class="card shadow mb-4">

	                <div class="card-header py-3">
	                    <h5 class="m-0 font-weight-bold text-primary">Add a new user</h5>
	                </div>

                	<div class="card-body">

                    	<form method="POST" action="{{ route('user.store') }}" autocomplete="off">
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	
                        	<!--
                        	<div class="pl-lg-4">
                        	-->
                            	<div class="row">
                                	<div class="col-lg-6">
	                                    <div class="form-group focused">
	                                        <label class="form-control-label" for="name">Name <span class="small text-danger">*</span></label>
	                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name', '') }}"/>
	                                        @error('name')
                                				<p class="text-sm text-danger">{{ $message }}</p>
                            				@enderror
	                                    </div>
                                	</div>
                                	<div class="col-lg-6">
                                    	<div class="form-group">
	                                        <label class="form-control-label" for="telephone">Phone</label>
	                                        <input type="number" id="telephone" class="form-control" name="telephone" placeholder="Phone" value="{{ old('telephone', '') }}" />
	                                        @error('telephone')
                                				<p class="text-sm text-red">{{ $message }}</p>
                            				@enderror
                                    	</div>
                                	</div>
                            	</div>  
                            	<div class="row">
                            		<div class="col-lg-6">
                                    	<div class="form-group">
                                        	<label class="form-control-label" for="email">Email address <span class="small text-danger">*</span></label>
                                        	<input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email', '') }}"/>
                                        	@error('email')
                                				<p class="text-sm text-red">{{ $message }}</p>
                            				@enderror
                                    	</div>
                                	</div>
                                	<div class="col-lg-6">
                                    	<div class="form-group">
                                    		<label class="form-control-label" for="role">Rôle <span class="small text-danger">*</span></label>
                                    		<select id="role" class="form-control" name="role">
                                    			@foreach($allRoles as $rol)
                                					<option value="{{$rol->id}}">{{$rol->name}}</option>
                                				@endforeach
                              				</select>
                              				
                                    	</div>
                                    </div>
                            	</div>
                            	<div class="row">
	                                <div class="col-lg-6">
	                                    <div class="form-group focused">
	                                        <label class="form-control-label" for="password">Password <span class="small text-danger">*</span></label>
	                                        <input type="password" id="password" class="form-control" name="password" placeholder="Password"/>
	                                        @error('password')
                                				<p class="text-sm text-red">{{ $message }}</p>
                            				@enderror
	                                    </div>
	                                </div>
	                                <div class="col-lg-6">
	                                    <div class="form-group focused">
	                                        <label class="form-control-label" for="confirmer_le_mot_de_passe">Confirm password <span class="small text-danger">*</span></label>
	                                        <input type="password" id="confirmer_le_mot_de_passe" class="form-control" name="confirmer_le_mot_de_passe" placeholder="Confirm password"/>
	                                    </div>
	                                </div>
                            	</div>
                            <!--
                        	</div>
                        	-->

	                        <!-- Button -->
	                        <div class="pl-lg-4">
	                            <div class="row">
	                                <div class="col text-center">
	                                    <button type="submit" class="btn btn-primary">Save</button>
	                                </div>
	                            </div>
	                        </div>
                    	</form>
                	</div>
                	<div class="card-footer"></div>
            	</div>
        	</div>
    	</div>
    </x-slot>
</x-app-layout>