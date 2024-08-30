@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p>{{ $message }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="180px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                       <span class="badge bg-success">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <form class="btn-group" action="{{ route('users.destroy',$user->id) }}" method="POST">
                                        <a class="btn" href="{{ route('users.show',$user->id) }}"><i class="fi fi-rr-eye"></i></a>
                                        <a class="btn" href="{{ route('users.edit',$user->id) }}"><i class="fi fi-rr-pen-square"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn"><i class="fi fi-rr-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
@endsection
