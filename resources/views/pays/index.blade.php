<x-app-layout>
    <x-slot name="header">

    </x-slot>

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
                        {{__('messages.All the countries')}} 
                    </h5>
                    @can('add-country')
                    <a class="btn btn-success btn-sm float-right" href="{{ route('countries.create') }}" role="button" data-toggle="tooltip">
                        {{__('messages.Add')}} <i class="fas fa-plus"></i>
                    </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="">
                                <tr>
                                    <th class="text-center">{{__('messages.Name')}}</th>   
                                    <th class="text-center">{{__('messages.Currency')}}</th>
                                    <th class="text-center">{{__('messages.Symbol')}}</th>
                                    <th class="text-center">{{__('messages.Tax')}}</th>
                                    <th colspan="3" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($countries as $country)
                                <tr>
                                    <td class="text-center">{{$country->nom}}</td>
                                    <td class="text-center">{{$country->currency}}</td>
                                    <td class="text-center">{{$country->symbol}}</td>
                                    <td class="text-center">{{$country->tax}}</td>

                                    @can('show-country')
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm " href="{{ route('countries.show', [$country->id]) }}" target="_blank" role="button" data-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    @endcan

                                    @can('edit-country')
                                        <td class="text-center">
                                            <a href="{{ route('countries.edit', [$country->id]) }}" class='btn btn-warning btn-sm'>
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    @endcan

                                    @can('delete-country')
                                        <td class="text-center">
                                            <form action="{{route('countries.destroy', $country->id)}} " method="post">
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
                    {{ $countries->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>