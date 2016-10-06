<?php

namespace App\Http\Controllers\Admin;

use App\AllocationType;
use App\DataTables\AllocationTypesDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserLogsDataTable;
use App\Http\Requests\AllocationTypeRequest;
use App\Repositories\AllocationTypesRepository;
use App\Repositories\UserLogsRepository;
use Illuminate\Http\Request;

class AllocationTypesController extends Controller
{
    public function index(Request $request, AllocationTypesDataTable $table)
    {
        $table->setUser($request->user());
        return $table->render('admin.allocation-types.index');
    }

    public function create(Request $request)
    {
        return view('admin.allocation-types.create', ['type' => new AllocationType]);
    }

    public function store(AllocationTypeRequest $request)
    {
        $inputs = $request->only('name', 'status');
        $type   = AllocationTypesRepository::create(new AllocationType, $inputs);
        UserLogsRepository::log($request->user(), 'create', $type, $request->getClientIp());
        return redirect()
            ->route('admin.allocation-types.index')
            ->with('notice', trans('allocation-types.notices.created', ['name' => $type->name]));
    }

    public function edit(AllocationType $type)
    {
        return view('admin.allocation-types.edit', compact('type'));
    }

    public function update(AllocationTypeRequest $request, AllocationType $type)
    {
        $inputs = $request->only('name', 'status');
        AllocationTypesRepository::update($type, $inputs);
        UserLogsRepository::log($request->user(), 'update', $type, $request->getClientIp());
        return redirect()
            ->route('admin.allocation-types.index')
            ->with('notice', trans('allocation-types.notices.updated', ['name' => $type->name]));
    }

    public function destroy(Request $request, AllocationType $type)
    {
        AllocationTypesRepository::delete($type);
        UserLogsRepository::log($request->user(), 'delete', $type, $request->getClientIp());
        return redirect()
            ->route('admin.allocation-types.index')
            ->with('notice', trans('allocation-types.notices.deleted', ['name' => $type->name]));
    }

    public function logs(AllocationType $type, UserLogsDataTable $table)
    {
        $table->setActionable($type);
        return $table->render('admin.allocation-types.logs', compact('type'));
    }

    public function revisions(AllocationType $type, RevisionsDataTable $table)
    {
        $table->setRevisionable($type);
        return $table->render('admin.allocation-types.revisions', compact('type'));
    }
}
