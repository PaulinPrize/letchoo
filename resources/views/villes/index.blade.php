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
                        {{__('messages.All the cities')}} 
                    </h5>
                    @can('add-city')
                    <a class="btn btn-success btn-sm float-right" href="{{ route('ville.create') }}" role="button" data-toggle="tooltip">
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
                                    <th class="text-center">{{__('messages.Postal code')}}</th>
                                    <th class="text-center">{{__('messages.Country')}}</th>
                                    <th colspan="3" style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($villes as $ville)
                                <tr class="text-center">
                                    <td>{{$ville->nom}}</td>
                                    <td class="text-center">{{$ville->ville_code_postal}}</td>
                                    <td class="text-center">{{$ville->pays->nom}}</td>

                                    @can('show-city')
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="{{ route('ville.show', [$ville->id]) }}" target="_blank" role="button" data-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    @endcan

                                    @can('edit-city')
                                        <td class="text-center">
                                            <a href="{{ route('ville.edit', [$ville->id]) }}" class='btn btn-warning btn-sm'>
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    @endcan

                                    @can('delete-city')
                                        <td class="text-center">
                                            <form action="{{route('ville.destroy', $ville->id)}} " method="post">
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
                    {{ $villes->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>