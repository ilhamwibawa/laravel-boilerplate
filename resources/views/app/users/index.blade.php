@extends('layouts.app')

@section('title', 'Users')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Users</h1>
    </div>

    <div class="section-body">
        @include('flash::message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4>User</h4>
                        @can('add_users')
                            <a href="{{ route('users.create') }}" class="btn btn-success">Create new user</a>
                        @endcan
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table table-striped']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('javascript')
    {!! $dataTable->scripts() !!}
@endpush
