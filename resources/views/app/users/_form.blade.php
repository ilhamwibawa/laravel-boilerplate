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
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control @if ($errors->has('password')) is-invalid @endif">
            @if ($errors->has('password')) <p class="invalid-feedback">{{ $errors->first('password') }}</p> @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @if ($errors->has('password')) is-invalid @endif">
            @if ($errors->has('password')) <p class="invalid-feedback">{{ $errors->first('password') }}</p> @endif
        </div>
    </div>
</div>
<div class="form-group">
    <label for="roles" class="d-block">Roles</label>
    {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null, ['class' => 'form-control selectric', 'multiple', 'style' => 'height:100%']) !!}

    @if ($errors->has('roles')) <p class="invalid-feedback">{{ $errors->first('roles') }}</p> @endif
</div>
