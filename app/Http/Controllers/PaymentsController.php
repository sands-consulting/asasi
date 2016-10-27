<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Package;
use App\Payment;
use App\Transaction;
use App\Http\Requests\PaymentRequest;
use App\Repositories\PaymentsRepository;
use PDF;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Session;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('payments.index');
    }

    public function endpoint()
    {
        return redirect()
            ->route('payments.redirect')
            ->with('notice', trans('payments.notices.paid'));
    }

    public function redirect(Request $request)
    {
        $vendor = $request->user()->vendor()->first();
        $notices = [];

        if (Cart::count() > 0) {
            foreach (Cart::content() as $content) {
                $vendor->notices()->attach($content->id);
                $notice = Notice::findOrFail($content->id);
                $notices[] = $notice;
            }
        }

        return redirect()
            ->route('payments.summary')
            ->with('notice', trans('payments.notices.payment_success'))
            ->with('notices', $notices);
    }

    public function summary()
    {
        $notices = Session::get('notices');
        
        if (empty($notices)) {
            return redirect()
                ->route('notices.my-notices');
        }

        return view('payments.summary', compact('notices'));
    }

    public function receipt(Transaction $transaction)
    {
        return view('payments.receipt', compact('transaction'));
    }

    public function printReceipt(Transaction $transaction)
    {
        return PDF::loadView('payments.printReceipt', $transaction)->inline('receipt.pdf');
        // return view('payments.printReceipt');
    }

    public function invoice(Transaction $transaction)
    {
        return view('payments.invoice', compact('transaction'));
    }

    public function printInvoice(Transaction $transaction)
    {
        return PDF::loadView('payments.printInvoice', compact('transaction'))->inline('invoice.pdf');
        // return view('payments.printInvoice');
    }
}
