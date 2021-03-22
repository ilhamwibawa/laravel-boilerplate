@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="section">
    <div class="section-header">
        <h4>Profile</h4>
    </div>
    @include('flash::message')
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3">
                                <ul class="nav nav-pills flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a href="#profile" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="true" class="nav-link active">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#password" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="true" class="nav-link">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8 offset-md-1">
                                <div class="tab-content no-padding" id="tabs">
                                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                        <form action="{{route('users.profile.update')}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control @if ($errors->has('name')) is-invalid @endif" @isset($user) value="{{$user->name}}" @endisset>
                                                @if ($errors->has('name')) <p class="invalid-feedback">{{ $errors->first('name') }}</p> @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control @if ($errors->has('email')) is-invalid @endif" @isset($user) value="{{$user->email}}" @endisset>
                                                @if ($errors->has('email')) <p class="invalid-feedback">{{ $errors->first('email') }}</p> @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="roles" class="d-block">Roles</label>
                                                {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null, ['class' => 'form-control selectric', 'multiple', 'style' => 'height:100%']) !!}

                                                @if ($errors->has('roles')) <p class="invalid-feedback">{{ $errors->first('roles') }}</p> @endif
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" value="Save" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel">
                                        <form action="{{route('users.profile.password')}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="current_password">Current Password</label>
                                                <input type="password" name="current_password" id="current_password" class="form-control @if ($errors->has('current_password')) is-invalid @endif">
                                                @if ($errors->has('current_password')) <p class="invalid-feedback">{{ $errors->first('current_password') }}</p> @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control @if ($errors->has('password')) is-invalid @endif">
                                                @if ($errors->has('password')) <p class="invalid-feedback">{{ $errors->first('password') }}</p> @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Password Confirmation</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @if ($errors->has('password')) is-invalid @endif">
                                                @if ($errors->has('password')) <p class="invalid-feedback">{{ $errors->first('password') }}</p> @endif
                                            </div>
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
            </div>
        </div>
    </div>
</div>
@endsection
