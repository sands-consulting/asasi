<?php

namespace App\Http\Controllers\Admin;

use App\QualificationCodeType;
use App\DataTables\QualificationCodeTypeDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\QualificationCodeTypeRequest;
use App\Services\QualificationCodeTypeService;
use App\Services\UserHistoriesService;
use Illuminate\Http\Request;

class QualificationCodeTypesController extends Controller
{
    public function index(Request $request, QualificationCodeTypeDataTable $table)
    {
        return $table->render('admin.qualification-code-types.index');
    }

    public function create(Request $request)
    {
        return view('admin.qualification-code-types.create', ['type' => new QualificationCodeType]);
    }

    public function store(QualificationCodeTypeRequest $request)
    {
        $type = QualificationCodeTypeService::create(new QualificationCodeType, $request->only('name', 'type', 'code', 'status'));

        if($request->input('parent_id', null) && $request->input('parent_id') != $type->parent_id)
        {
            $type->makeChildOf(QualificationCodeType::find($request->input('parent_id')));
        }
        else
        {
            $type->makeRoot();
        }

        UserHistoriesService::log($request->user(), 'create', $type, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-code-types.index')
            ->with('notice', trans('qualification-code-types.notices.created', ['name' => $type->name]));
    }

    public function edit(QualificationCodeType $type)
    {
        return view('admin.qualification-code-types.edit', compact('type'));
    }

    public function update(QualificationCodeTypeRequest $request, QualificationCodeType $type)
    {
        $type = QualificationCodeTypeService::update($type, $request->only('name', 'type', 'code', 'status'));

        if($request->input('parent_id', null) && $request->input('parent_id') != $type->parent_id)
        {
            $type->makeChildOf(QualificationCodeType::find($request->input('parent_id')));
        }
        else if($type->isChild())
        {
            $type->makeRoot();
        }

        UserHistoriesService::log($request->user(), 'update', $type, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-code-types.index')
            ->with('notice', trans('qualification-code-types.notices.updated', ['name' => $type->name]));
    }

    public function destroy(Request $request, QualificationCodeType $type)
    {
        QualificationCodeTypeService::delete($type);
        UserHistoriesService::log($request->user(), 'delete', $type, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-code-types.index')
            ->with('alert', trans('qualification-code-types.notices.deleted', ['name' => $type->name]));
    }

    public function logs(QualificationCodeType $type, UserHistoriesDataTable $table)
    {
        $table->setActionable($type);
        return $table->render('admin.qualification-code-types.logs', compact('type'));
    }

    public function revisions(QualificationCodeType $type, RevisionsDataTable $table)
    {
        $table->setRevisionable($type);
        return $table->render('admin.qualification-code-types.revisions', compact('type'));
    }
}
