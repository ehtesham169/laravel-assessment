@extends('layouts.app')

@section('title', 'Deposit Funds')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="main-home-text mt-3 mb-3">
                <div class="main-content">
                    <x-card title="Deposit Funds">
                        @include('components.messages.success')
                        <form action="{{ route('deposit.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="amount">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount to deposit" step="0.01" min="0.01" required>
                                @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Deposit</button>
                        </form>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection