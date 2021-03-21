<a href="{{ route('users.edit', $id)}}" class="btn btn-primary">Edit</a>
<form class="d-inline" action="{{ route('users.destroy', $id)}}">
    <button class="btn btn-danger" type="submit">Delete</button>
</form>
