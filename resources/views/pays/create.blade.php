<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="row">
        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{__('messages.Add')}}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('countries.store') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="nom">{{__('messages.Name')}} <span class="small text-danger">*</span></label>
                                    <input type="text" id="nom" class="form-control" name="nom" placeholder="Ex: Cameroun" value="{{ old('nom', '') }}"/>
                                    @error('nom')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="currency">{{__('messages.Currency')}} <span class="small text-danger">*</span></label>
                                    <input type="text" id="currency" class="form-control" name="currency" placeholder="Ex: XAF" value="{{ old('currency', '') }}"/>
                                    @error('currency')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="symbol">{{__('messages.Symbol')}} <span class="small text-danger">*</span></label>
                                    <input type="text" id="symbol" class="form-control" name="symbol" placeholder="Ex: F CFA" value="{{ old('symbol', '') }}"/>
                                    @error('symbol')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="tax">{{__('messages.Tax')}} <span class="small text-danger">*</span></label>
                                    <input type="text" id="tax" class="form-control" name="tax"  value="{{ old('tax', '') }}"/>
                                    @error('tax')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
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