<div class="row">
    <div class="col-12">
        <div class="card mb-2">
            <div class="card-header">
                <h4>{{ $title ?? 'Override Permissions' }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h6>View</h6>
                    </div>
                    <div class="col-md-3">
                        <h6>Add</h6>
                    </div>
                    <div class="col-md-3">
                        <h6>Edit</h6>
                    </div>
                    <div class="col-md-3">
                        <h6>Delete</h6>
                    </div>
                    @foreach ($permissions as $perm)
                        <?php
                            $per_found = null;

                            if( isset($role) ) {
                                $per_found = $role->hasPermissionTo($perm->name);
                            }

                            if( isset($user)) {
                                $per_found = $user->hasDirectPermission($perm->name);
                            }
                        ?>

                        <div class="col-md-3">
                            <div class="checkbox">
                                <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                </label>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
