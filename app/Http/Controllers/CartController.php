<?php

namespace App\Http\Controllers;

use App\Notice;
use App\PaymentGateway;
use Cart;
use Illuminate\Http\Request;
use JavaScript;

class CartController extends Controller
{
    public function index()
    {
        JavaScript::put([
            'items' => Notice::whereIn('id', Cart::content()->pluck('id'))->with('organization', 'taxCode')->get(),
            'gateways' => PaymentGateway::whereStatus('active')->whereDefault(1)->orderBy('label')->get()
        ]);
        return view('cart.index');
    }

    public function add(Request $request)
    {
        $notice = Notice::with('organization')->published()->find($request->route('notice'));
        $item   = Cart::add($notice->id, $notice->name, 1, $notice->price, ['number' => $notice->number]);
        $item->associate('App\Notice');

        return redirect()
            ->back()
            ->with('notice', trans('cart.notices.added', ['name' => $item->number]));
    }

    public function remove(Request $request)
    {
        $noticeId = $request->route('id');
        $item = Cart::first(function($item, $rowId) use($noticeId) {
            return $item->id == $noticeId;
        });
        Cart::remove($item->rowId);
        return redirect()
            ->back()
            ->with('notice', trans('cart.notices.removed', ['name' => $item->number]));
    }

    public function destroy(Request $request)
    {
        Cart::destroy();
        return redirect()
            ->route('cart')
            ->with('alert', trans('cart.notices.destroyed'));
    }

    public function checkout()
    {
    }
}
