@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="main-home-text mt-3 mb-3">
                <div class="main-content">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Welcome, {{ $user->name }}!</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Your ID:</strong> {{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text">
                                        <strong>Your Balance:</strong> 
                                        ${{ $balance }}
                                    </p>
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
