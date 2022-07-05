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
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>

                @can('show-role')
                <td class="text-center">
                    <a class="btn btn-primary btn-sm " href="{{ route('roles.show', [$role->id]) }}" target="_blank" role="button" data-toggle="tooltip">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
                @endcan

                @can('edit-role')
                <td class="text-center">
                    <a href="{{ route('roles.edit', [$role->id]) }}" class='btn btn-warning btn-sm'>
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                @endcan

                @can('delete-role')
                <td class="text-center">
                    <form action="{{route('roles.destroy', $role->id)}} " method="post">
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
