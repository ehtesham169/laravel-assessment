<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBalance;

class DepositController extends Controller
{
    /**
     * Show the deposit form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('deposit.form');
    }

    /**
     * Handle the deposit request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deposit(Request $request)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        // Get the authenticated user
        $user = Auth::user();
        $balance = $user->balance;

        // Check if the user has a balance record
        if (!$balance) {
            // If no balance record, create one with the deposited amount
            UserBalance::create([
                'user_id' => $user->id,
                'balance' => $request->input('amount')
            ]);
        } else {
            // Otherwise, update the existing balance
            $balance->increment('balance', $request->input('amount'));
        }

        // Log the transaction
        $user = Auth::user();
        $user->transactions()->create([
            'type' => 'Deposit',
            'amount' => $request->input('amount')
        ]);        

        // Redirect back with success message
        return redirect()->route('deposit.form')->with('success', 'Balance added successfully!');
    }
}
