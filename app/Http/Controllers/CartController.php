<?php

namespace App\Http\Controllers;

use App\Notice;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items  = Cart::contents();
        return view('cart.index', compact('items'));
    }

    public function add(Request $request)
    {
        $notice = Notice::with('organization')->published()->find($request->input('id'));
        $item   = Cart::add($notice->id, $notice->name, 1, $notice->price, [
                    'number' => $notice->number,
                    'organization' => $notice->organization->short_name
                ]);
        $item->associate('Notice');

        return redirect()
            ->back()
            ->with('notice', trans('cart.flash.added', ['name' => $item->number]));
    }

    public function remove(Request $request)
    {
        $item = Cart::get($request->input('id'));
        Cart::remove($item->id);
        return redirect()
            ->route('cart')
            ->with('notice', trans('cart.flash.removed', ['name' => $item->options->number]));
    }

    public function destroy()
    {
        Cart::destroy();
    }

    public function checkout()
    {
    }
}
