<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Cart;

class CartsController extends Controller
{
    public function index()
    {
        $contents = Cart::content();
        return view()->make('carts.index', compact('contents'));
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

    public function save($cart)
    {
        $cart = serialize(Cart::content());
    }

    public function destroy()
    {
        Cart::destroy();
    }
}
