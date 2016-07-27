<?php

namespace App\Http\Controllers\Admin;

use App\Vendor;
use App\DataTables\VendorsDataTable;
use App\Http\Requests\VendorRequest;
use App\Repositories\VendorsRepository;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(VendorsDataTable $table)
    {
        return $table->render('admin.vendors.index');
    }

    public function show(Vendor $vendor)
    {
        return view('admin.vendors.show', compact('vendor'));
    }
    
    public function create()
    {
        return view('admin.vendors.create');
    }

    public function store(VendorRequest $request)
    {
        $inputs = $request->all();
        $vendor = VendorsRepository::create(new Vendor, $inputs);

        return redirect()
            ->route('vendors.pending', $vendor->id)
            ->with('notice', trans('vendors.notices.created', ['name' => $vendor->name]));
    }

    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $inputs = $request->all();

        $vendor = VendorsRepository::update($vendor, $inputs);

        return redirect()
            ->route('admin.vendors.edit', $vendor->id)
            ->with('notice', trans('vendors.notices.updated', ['name' => $vendor->name]));
    }
}
