<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Add')}}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ville.store') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="nom">{{__('messages.Name')}} <span class="small text-danger">*</span></label>
                                    <input type="text" id="nom" class="form-control" name="nom" placeholder="Ex: Paris" value="{{ old('nom', '') }}"/>
                                    @error('nom')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_code_postal">{{__('messages.Postal code')}} </label>
                                    <input type="text" id="ville_code_postal" class="form-control" name="ville_code_postal" placeholder="Ex : 75010" value="{{ old('ville_code_postal', '') }}"/>
                                    @error('ville_code_postal')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_longitude">Longitude </label>
                                    <input type="text" id="ville_longitude" class="form-control" name="ville_longitude" value="{{ old('ville_longitude', '') }}"/>
                                    @error('ville_longitude')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_latitude">Latitude </label>
                                    <input type="text" id="ville_latitude" class="form-control" name="ville_latitude"value="{{ old('ville_latitude', '') }}"/>
                                    @error('ville_latitude')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_longitude_grd">Ville longitude grd </label>
                                    <input type="text" id="ville_longitude_grd" class="form-control" name="ville_longitude_grd" value="{{ old('ville_longitude_grd', '') }}"/>
                                    @error('ville_longitude_grd')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_latitude_grd">Ville latitude grd</label>
                                    <input type="text" id="ville_latitude_grd" class="form-control" name="ville_latitude_grd"value="{{ old('ville_latitude_grd', '') }}"/>
                                    @error('ville_latitude_grd')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_longitude_dms">Ville longitude dms </label>
                                    <input type="text" id="ville_longitude_dms" class="form-control" name="ville_longitude_dms" value="{{ old('ville_longitude_dms', '') }}"/>
                                    @error('ville_longitude_dms')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_latitude_dms">Ville latitude dms</label>
                                    <input type="text" id="ville_latitude_dms" class="form-control" name="ville_latitude_dms"value="{{ old('ville_latitude_dms', '') }}"/>
                                    @error('ville_latitude_dms')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_zmin">Ville Zmin </label>
                                    <input type="text" id="ville_zmin" class="form-control" name="ville_zmin" value="{{ old('ville_zmin', '') }}"/>
                                    @error('ville_zmin')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="ville_zmax">Ville Zmax</label>
                                    <input type="text" id="ville_zmax" class="form-control" name="ville_zmax"value="{{ old('ville_zmax', '') }}"/>
                                    @error('ville_zmax')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="pays_id">{{__('messages.Country')}} <span class="small text-danger">*</span></label>
                                    <select id="pays_id" class="form-control" name="pays_id">
                                        @foreach($pays as $p)
                                        <option value="{{$p->id}}">{{$p->nom}}</option>
                                        @endforeach
                                    </select>   
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">{{__('messages.Save')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</x-app-layout>