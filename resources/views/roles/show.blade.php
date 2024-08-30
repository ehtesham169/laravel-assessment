@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Show Role</div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            <ul>
                                @foreach ($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
