<?php

namespace App\Http\Controllers\Admin;

use App\Allocation;
use App\Organization;
use App\DataTables\AllocationDataTable;
use App\DataTables\AllocationNoticeDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\AllocationRequest;
use App\Services\AllocationService;
use App\Services\UserHistoriesService;
use Illuminate\Http\Request;

class AllocationsController extends Controller
{
    protected $allocation;

    public function __construct(AllocationService $allocation)
    {
        parent::__construct();
        $this->allocation = $allocation;
    }

    public function index(Request $request, AllocationDataTable $table)
    {
        $table->setUser($request->user());
        return $table->render('admin.allocations.index');
    }

    public function show(Allocation $allocation, AllocationNoticeDataTable $table)
    {
        return $table->forId($allocation->id)->render('admin.allocations.show', compact('allocation'));
    }

    public function create(Request $request)
    {
        return view('admin.allocations.create', ['allocation' => new Allocation]);
    }

    public function store(AllocationRequest $request)
    {
        $inputs = $request->only('name', 'value', 'status', 'type_id');

        if($request->user()->hasPermission('allocation:organization')) {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        } else {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        $allocation   = AllocationService::create(new Allocation, $inputs);
        UserHistoriesService::log($request->user(), 'create', $allocation, $request->getClientIp());
        return redirect()
            ->route('admin.allocations.show', $allocation->id)
            ->with('notice', trans('allocations.notices.created', ['name' => $allocation->name]));
    }

    public function edit(Allocation $allocation)
    {
        return view('admin.allocations.edit', compact('allocation'));
    }

    public function update(AllocationRequest $request, Allocation $allocation)
    {
        $inputs = $request->only('name', 'value', 'status', 'type_id');

        if($request->user()->hasPermission('allocation:organization'))
        {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        }
        else
        {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        AllocationService::update($allocation, $inputs);
        UserHistoriesService::log($request->user(), 'update', $allocation, $request->getClientIp());
        return redirect()
            ->route('admin.allocations.show', $allocation->id)
            ->with('notice', trans('allocations.notices.updated', ['name' => $allocation->name]));
    }

    public function destroy(Allocation $allocation)
    {
        AllocationService::delete($allocation);
        UserHistoriesService::log($request->user(), 'delete', $allocation, $request->getClientIp());
        return redirect()
            ->route('admin.allocations.index')
            ->with('notice', trans('allocations.notices.deleted', ['name' => $allocation->name]));
    }

    public function logs(Allocation $allocation, UserHistoriesDataTable $table)
    {
        $table->setActionable($allocation);
        return $table->render('admin.allocations.logs', compact('allocation'));
    }

    public function revisions(Allocation $allocation, RevisionsDataTable $table)
    {
        $table->setRevisionable($allocation);
        return $table->render('admin.allocations.revisions', compact('allocation'));
    }
}
