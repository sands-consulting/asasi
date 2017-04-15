<?php

namespace App\Http\Controllers;

use App\DataTables\VendorSubscriptionsDataTable;
use App\Events\VendorApplied;
use App\Events\VendorCancelled;
use App\Http\Requests\VendorRequest;
use App\Notificators\VendorAppliedNotificator;
use App\Services\VendorsService;
use App\Vendor;
use Auth;
use Illuminate\Http\Request;
use Route;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact($user));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact($user));
    }

    public function update(User $user)
    {
        return view('users.edit');
    }

    public function destroy(User $user)
    {
        return view('users.edit');
    }
}
