<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Transaction;
use App\DataTables\TransactionsDataTable;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(TransactionsDataTable $table)
    {
        return $table->render('admin.transactions.index');
    }

    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }
}
