<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Package;
use App\Payment;
use App\Http\Requests\PaymentRequest;
use App\Repositories\PaymentsRepository;
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

    public function redirect()
    {
        $vendor = Auth::user()->vendor;
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

    public function receipt()
    {
        return view('payments.receipt');
    }

    public function invoice()
    {
        return view('payments.invoice');
    }
}
