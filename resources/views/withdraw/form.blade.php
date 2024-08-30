@extends('layouts.app')

@section('title', 'Withdraw Funds')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="Withdraw Funds">

                @include('components.messages.success')
                @include('components.messages.error')

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('withdraw.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="amount">Amount</label>
                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            class="form-control"
                            placeholder="Enter amount to withdraw"
                            step="0.01"
                            min="0.01"
                            required>
                        @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Withdraw</button>
                </form>
            </x-card>
        </div>
    </div>
</div>
@endsection