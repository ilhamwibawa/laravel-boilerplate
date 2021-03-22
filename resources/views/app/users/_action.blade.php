@can('edit_users')
    <a href="{{ route('users.edit', $id)}}" class="btn btn-primary">Edit</a>
@endcan
@can('delete_users')
    <form class="d-inline" action="{{ route('users.destroy', $id)}}" method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete this user?')" type="submit">Delete</button>
    </form>
@endcan
