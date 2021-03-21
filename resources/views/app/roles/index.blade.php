@extends('layouts.app')

@section('title', 'Roles')

@section('content')

<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['method' => 'post']) !!}

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="roleModalLabel">New Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <!-- name Form Input -->
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                <!-- Submit Form Button -->
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<section class="section">
    <div class="section-header d-flex align-items-center justify-content-between">
        <h4>Role Management</h4>
        @can('add_roles')
            <a href="#" class="btn btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i class="fa fa-plus"></i> New Role</a>
        @endcan
    </div>
    @include('flash::message')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @forelse ($roles as $role)
                    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id ], 'class' => 'mb-4']) !!}

                    @if($role->name === 'admin')
                        @include('shared._permissions', [ 'title' => $role->name .' Permissions', 'options' => ['disabled'] ])
                    @else

                        @include('shared._permissions', [ 'title' => $role->name .' Permissions', 'model' => $role ])

                        @can('edit_roles')
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        @endcan
                    @endif

                    {!! Form::close() !!}

                    @empty
                        <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
