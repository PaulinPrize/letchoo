<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>{{__('messages.Name')}}</th>
                <th>{{__('messages.Guard Name')}}</th>
                <th colspan="3" style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>

                @can('show-permission')
                <td class="text-center">
                    <a class="btn btn-primary btn-sm " href="{{ route('permissions.show', [$permission->id]) }}" target="_blank" role="button" data-toggle="tooltip">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
                @endcan

                @can('edit-permission')
                <td class="text-center">
                    <a href="{{ route('permissions.edit', [$permission->id]) }}" class='btn btn-warning btn-sm'>
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                @endcan

                @can('delete-permission')
                <td class="text-center">
                    <form action="{{route('permissions.destroy', $permission->id)}} " method="post">
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


