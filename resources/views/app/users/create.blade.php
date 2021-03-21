@extends('layouts.app')

@section('title', 'Create new user')

@section('content')
<div class="section">
    <div class="section-header">
        <h4>Create new user</h4>
    </div>
    @include('flash::message')
    <div class="section-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            @include('app.users._form')
                            <div class="form-group">
                                <input type="submit" value="Create" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
