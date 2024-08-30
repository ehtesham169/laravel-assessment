<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class StatementController extends Controller
{
    public function index()
    {
        // Fetch transaction logs for the logged-in user
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('statement.index', compact('transactions'));
    }
}
