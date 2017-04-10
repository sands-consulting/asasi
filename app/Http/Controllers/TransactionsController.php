<?php

namespace App\Http\Controllers;

use App\Transaction;
use Auth;
use Illuminate\Http\Request;
use Route;

class TransactionsController extends Controller
{
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function invoice(Transaction $transaction, Request $request)
    {
        return view('transactions.invoice', compact('transaction'));
    }
}
