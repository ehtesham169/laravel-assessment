@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Roles</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('roles.create') }}" class="btn btn-success">Create New Role</a>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p>{{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <table class="table table-hover">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <!-- <th>Permissions</th> -->
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <!-- <td>
                                    <ul>
                                        @foreach ($role->permissions as $permission)
                                            <li>{{ $permission->name }}</li>
                                        @endforeach
                                    </ul>
                                </td> -->
                                <td>
                                    <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
