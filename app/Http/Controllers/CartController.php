<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items  = Cart::contents();
        return view('cart.index', compact('items'));
    }

    public function add($item)
    {
        $cartItem = Cart::add($item->id, $item->name, 1, $item->price, ['number' => $item->number,'description' => $item->description]);
        $cartItem->associate('Notice');

        return redirect()
            ->back()
            ->with('notice', trans('carts.notices.added', ['name' => $item->number]));
    }

    public function remove($rowId)
    {
        $item = Cart::get($rowId);
        Cart::remove($rowId);
        return redirect()
            ->route('carts.index')
            ->with('notice', trans('carts.notices.removed', ['name' => $item->options->number]));
    }

    public function destroy()
    {
        Cart::destroy();
    }

    public function checkout()
    {
    }
}
