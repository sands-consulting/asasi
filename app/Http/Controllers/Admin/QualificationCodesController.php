<?php

namespace App\Http\Controllers\Admin;

use App\QualificationCode;
use App\QualificationCodeType;
use App\DataTables\QualificationCodeDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserLogsDataTable;
use App\Http\Requests\QualificationCodeRequest;
use App\Repositories\QualificationCodeRepository;
use App\Repositories\UserLogsRepository;
use Illuminate\Http\Request;

class QualificationCodesController extends Controller
{
    public function index(Request $request, QualificationCodeDataTable $table)
    {
        return $table->render('admin.qualification-codes.index');
    }

    public function create(Request $request)
    {
        return view('admin.qualification-codes.create', ['code' => new QualificationCode]);
    }

    public function store(QualificationCodeRequest $request)
    {
        $code = QualificationCodeRepository::create(new QualificationCode, $request->only('code', 'name', 'status', 'type_id'));
        UserLogsRepository::log($request->user(), 'create', $code, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-codes.index')
            ->with('notice', trans('qualification-codes.notices.created', ['code' => $code->code, 'name' => $code->name]));
    }

    public function edit(QualificationCode $code)
    {
        return view('admin.qualification-codes.edit', compact('code'));
    }

    public function update(QualificationCodeRequest $request, QualificationCode $code)
    {
        QualificationCodeRepository::update($code, $request->only('code', 'name', 'status', 'type_id'));
        UserLogsRepository::log($request->user(), 'update', $code, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-codes.index')
            ->with('notice', trans('qualification-codes.notices.updated', ['code' => $code->code, 'name' => $code->name]));
    }

    public function destroy(Request $request, QualificationCode $code)
    {
        QualificationCodeRepository::delete($code);
        UserLogsRepository::log($request->user(), 'delete', $code, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-codes.index')
            ->with('alert', trans('qualification-codes.notices.deleted', ['code' => $code->code, 'name' => $code->name]));
    }

    public function logs(Qualification $code, UserLogsDataTable $table)
    {
        $table->setActionable($code);
        return $table->render('admin.qualification-codes.logs', compact('code'));
    }

    public function revisions(Qualification $code, RevisionsDataTable $table)
    {
        $table->setRevisionable($code);
        return $table->render('admin.qualification-codes.revisions', compact('code'));
    }
}