<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBalance;

class UserBalanceController extends Controller
{
    public function index()
    {
        $balances = UserBalance::all();
        return view('balances.index', compact('balances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'balance' => 'required|numeric',
        ]);

        UserBalance::create($request->all());
        return redirect()->route('balances.index');
    }

    public function show($id)
    {
        $balance = UserBalance::findOrFail($id);
        return view('balances.show', compact('balance'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'balance' => 'required|numeric',
        ]);

        $balance = UserBalance::findOrFail($id);
        $balance->update($request->all());
        return redirect()->route('balances.index');
    }

    public function destroy($id)
    {
        $balance = UserBalance::findOrFail($id);
        $balance->delete();
        return redirect()->route('balances.index');
    }
}
