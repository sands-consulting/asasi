<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VendorTypesDataTable;
use App\VendorType;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\VendorTypeRequest;
use App\Services\VendorTypeService;
use App\Services\UserHistoryService;
use Illuminate\Http\Request;

class VendorTypesController extends Controller
{
    public function index(Request $request, VendorTypesDataTable $table)
    {
        return $table->render('admin.vendor-types.index');
    }

    public function create(Request $request)
    {
        return view('admin.vendor-types.create', ['type' => new VendorType]);
    }

    public function store(VendorTypeRequest $request)
    {
        $inputs = $request->only('incorporation_authority', 'incorporation_type', 'status');
        $type = VendorTypeService::create(new VendorType, $inputs);
        UserHistoryService::log($request->user(), 'create', $type, $request->getClientIp());
        return redirect()
            ->route('admin.vendor-types.edit', $type->id)
            ->with('notice', trans('vendor-types.notices.created', ['name' => $type->incorporation_authority]));
    }

    public function edit(VendorType $type)
    {
        return view('admin.vendor-types.edit', compact('type'));
    }

    public function update(VendorTypeRequest $request, VendorType $type)
    {
        $inputs = $request->only('incorporation_authority', 'incorporation_type', 'status');
        VendorTypeService::update($type, $inputs);
        UserHistoryService::log($request->user(), 'update', $type, $request->getClientIp());
        return redirect()
            ->route('admin.vendor-types.edit', $type->id)
            ->with('notice', trans('vendor-types.notices.updated', ['name' => $type->incorporation_authority]));
    }

    public function destroy(Request $request, VendorType $type)
    {
        VendorTypeService::delete($type);
        UserHistoryService::log($request->user(), 'delete', $type, $request->getClientIp());
        return redirect()
            ->route('admin.vendor-types.index')
            ->with('notice', trans('vendor-types.notices.deleted', ['name' => $type->incorporation_authority]));
    }

    public function histories(VendorType $type, UserHistoriesDataTable $table)
    {
        $table->setActionable($type);
        return $table->render('admin.vendor-types.histories', compact('type'));
    }

    public function revisions(VendorType $type, RevisionsDataTable $table)
    {
        $table->setRevisionable($type);
        return $table->render('admin.vendor-types.revisions', compact('type'));
    }
}
