<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserBalance;

class TransferController extends Controller
{
    /**
     * Show the transfer form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        $users = User::where('id', '!=', Auth::id())->pluck('email', 'id'); // Exclude current user
        return view('transfer.form', compact('users'));
    }

    /**
     * Handle the transfer request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function transfer(Request $request)
    {
        // Validate the request
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01'
        ]);

        // Get the authenticated user
        $user = Auth::user();
        $balance = $user->balance;

        // Check if the user has a balance record
        if (!$balance || $balance->balance < $request->input('amount')) {
            return redirect()->route('transfer.form')->with('error', 'Insufficient balance!');
        }

        // Find the recipient
        $recipient = User::find($request->input('recipient_id'));
        $recipientBalance = $recipient->balance;

        // Deduct the amount from the sender's balance
        $balance->decrement('balance', $request->input('amount'));

        // Add the amount to the recipient's balance
        if (!$recipientBalance) {
            // If recipient does not have a balance record, create one
            UserBalance::create([
                'user_id' => $recipient->id,
                'balance' => $request->input('amount'),
            ]);
        } else {
            $recipientBalance->increment('balance', $request->input('amount'));
        }

        // Log the transaction for the sender
        $user = Auth::user();
        $user->transactions()->create([
            'type' => 'Transfer Out',
            'amount' => $request->input('amount')
        ]);

        // Log the transaction for the recipient
        $recipient = User::find($request->input('recipient_id'));
        $recipient->transactions()->create([
            'type' => 'Transfer In',
            'amount' => $request->input('amount')
        ]);        

        // Redirect back with success message
        return redirect()->route('transfer.form')->with('success', 'Amount successfully transferred!');
    }
}
