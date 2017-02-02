<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactRequest $request)
    {
    	return redirect()
    			->back()
    			->with('alert', trans('contact.flash.created'));
    }
}
