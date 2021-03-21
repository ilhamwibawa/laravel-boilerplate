@extends('layouts.app')

@section('title', 'User Edit')

@section('content')
<div class="section">
    <div class="section-header">
        <h4>Edit User {{$user->name}}</h4>
    </div>
    @include('flash::message')
    <div class="section-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('app.users._form')
                            <div class="form-group">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
