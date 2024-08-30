<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBalance;

class WithdrawController extends Controller
{
    /**
     * Show the withdrawal form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('withdraw.form');
    }

    /**
     * Handle the withdrawal request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function withdraw(Request $request)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        // Get the authenticated user
        $user = Auth::user();
        $balance = $user->balance;

        // Check if the user has a balance record
        if (!$balance || $balance->balance < $request->input('amount')) {
            return redirect()->route('withdraw.form')->with('error', 'Insufficient balance!');
        }

        // Deduct the amount from the balance
        $balance->decrement('balance', $request->input('amount'));

        // Log the transaction
        $user = Auth::user();
        $user->transactions()->create([
            'type' => 'Withdraw',
            'amount' => $request->input('amount')
        ]);        

        // Redirect back with success message
        return redirect()->route('withdraw.form')->with('success', 'Amount successfully withdrawn!');
    }
}
