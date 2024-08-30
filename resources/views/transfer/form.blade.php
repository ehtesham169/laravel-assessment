@extends('layouts.app')

@section('title', 'Transfer Funds')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="Transfer Funds">
                @include('components.messages.success')
                @include('components.messages.error')
                <form action="{{ route('transfer.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="recipient_id">Recipient Email</label>
                        <select id="recipient_id" name="recipient_id" class="form-control" required>
                            <option value="">Select recipient</option>
                            @foreach($users as $id => $email)
                            <option value="{{ $id }}">{{ $email }}</option>
                            @endforeach
                        </select>
                        @error('recipient_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter the amount to transfer" step="0.01" min="0.01" required>
                        @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Transfer</button>
                </form>
            </x-card>
        </div>
    </div>
</div>
@endsection