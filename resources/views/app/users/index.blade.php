@extends('layouts.app')

@section('title', 'Users')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User Management</h1>
    </div>

    <div class="section-body">
        @include('flash::message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4>User</h4>
                        @can('add_users')
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Create new user</a>
                        @endcan
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td><img src="{{ Avatar::create($user->name)->toBase64() }}"
                                                alt="{{$user->name}}" class="rounded-circle" width="24"></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->getRoleNames()}}</td>
                                        <td>
                                            @can('edit_users')
                                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
                                            @endcan
                                            @can('delete_users')
                                                <form class="d-inline" action="{{route('users.destroy', $user->id)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
