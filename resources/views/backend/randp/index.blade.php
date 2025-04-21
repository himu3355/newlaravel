@extends('layouts.admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles And Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Roles And Permissions</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">

            @if (session()->has('errorMessage'))
                <div class="alert alert-danger">
                    {{ session()->has('errorMessage') ? session()->get('errorMessage') : '' }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('rolesandpermission.role.add') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                Add New Role
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="roleName">Role Name</label>
                                    <input type="text" class="form-control @error('roleName') is-invalid @enderror"
                                        name="roleName" id="roleName" placeholder="Role Name">
                                    @error('roleName')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" value="Add Role" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('rolesandpermission.permission.add') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                Add New permission
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="permissionName">permission Name</label>
                                    <input type="text" class="form-control @error('permissionName') is-invalid @enderror"
                                        name="permissionName" id="permissionName" placeholder="permission Name">
                                    @error('permissionName')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" value="Add Role" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 200px;"></th>
                                @foreach ($roles as $role)
                                    <th>
                                        <div class="row">
                                            <div class="col-6">
                                                {{ $role->name }}
                                            </div>
                                            <div class="col-6 text-right">
                                                <form action="{{ route('rolesandpermission.role.delete', $role->id) }}"
                                                    method="post"
                                                    onsubmit="return confirm('You can not revert again. are you sure deletion for role?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('rolespermission.update') }}" method="post">
                                @csrf
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    {{ $permission->name }}
                                                </div>
                                                <div class="col-6 text-right">
                                                    <button type="button" class="btn btn-sm btn-danger permissionDelete"
                                                        data-id="{{ $permission->id }}">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($roles as $role)
                                            <td>
                                                <input type="checkbox" name="{{ $role->name }}[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->name, $role->getAllPermissions()->pluck('name')->toArray()) ? 'checked' : '' }} />
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="{{ $roles->count() + 1 }}" class="text-right">
                                    <input type="Submit" value="Save" class="btn btn-primary" />
                                </th>
                            </tr>
                        </tfoot>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-js')
    <script>
        $('.permissionDelete').on('click', function(e) {
            e.preventDefault();
            if (confirm('You can not revert again. are you sure deletion for role?')) {
                var uurl = "/rolesandpermission/permission/" + $(this).attr('data-id') + "/delete";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: uurl,
                    type: 'delete', // replaced from put
                    dataType: "JSON",
                    success: function(response) {
                        if (response == 1) {
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr
                        .responseText); // this line will save you tons of hours while debugging
                        // do something here because of error
                    }
                });
            }
        });
    </script>
@endsection
