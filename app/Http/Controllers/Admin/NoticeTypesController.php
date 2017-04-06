<?php

namespace App\Http\Controllers\Admin;

use App\NoticeType;
use App\DataTables\NoticeTypesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\NoticeTypeRequest;
use App\Services\NoticeTypeService;
use App\Services\UserHistoryService;
use Illuminate\Http\Request;

class NoticeTypesController extends Controller
{
    public function index(NoticeTypesDataTable $table)
    {
        return $table->render('admin.notice-types.index');
    }

    public function create(Request $request)
    {
        return view('admin.notice-types.create', ['noticeType' => new NoticeType]);
    }

    public function store(NoticeTypeRequest $request)
    {
        $inputs = $request->only('name');

        $noticeType = NoticeTypeService::create(new NoticeType, $inputs);
        UserHistoryService::log($request->user(), 'create', $noticeType, $request->getClientIp());
        return redirect()
            ->route('admin.notice-types.edit', $noticeType->id)
            ->with('notice', trans('notice-types.notices.created', ['name' => $noticeType->name]));
    }

    public function edit(NoticeType $noticeType)
    {
        return view('admin.notice-types.edit', compact('noticeType'));
    }

    public function update(NoticeTypeRequest $request, NoticeType $noticeType)
    {
        $inputs = $request->only(
            'name'
        );

        $noticeType = NoticeTypeService::update($noticeType, $inputs);
        UserHistoryService::log($request->user(), 'update', $noticeType, $request->getClientIp());
        return redirect()
            ->route('admin.notice-types.edit', $noticeType->id)
            ->with('notice', trans('notice-types.notices.updated', ['name' => $noticeType->name]));
    }

    public function destroy(Request $request, NoticeType $noticeType)
    {
        NoticeTypeService::delete($noticeType);
        UserHistoryService::log($request->user(), 'delete', $noticeType, $request->getClientIp());
        return redirect()
            ->route('admin.notice-types.index')
            ->with('notice', trans('notice-types.notices.deleted', ['name' => $noticeType->name]));
    }

    public function histories(NoticeType $noticeType, NoticeTypeLogsDataTable $table)
    {
        $table->setActionable($noticeType);
        return $table->render('admin.notice-types.histories', compact('noticeType'));
    }

    public function revisions(NoticeType $noticeType, RevisionsDataTable $table)
    {
        $table->setRevisionable($noticeType);
        return $table->render('admin.notice-types.revisions', compact('noticeType'));
    }

    public function activate(Request $request, NoticeType $noticeType)
    {
        NoticeTypeService::activate($noticeType);
        UserHistoryService::log($request->user(), 'activate', $noticeType, $request->getClientIp());
        return redirect()
            ->to($request->input('redirect_to', route('admin.notice-types.edit', $noticeType->id)))
            ->with('notice', trans('notice-types.notices.activated', ['name' => $noticeType->name]));
    }

    public function deactivate(Request $request, NoticeType $noticeType)
    {
        NoticeTypeService::deactivate($noticeType);
        UserHistoryService::log($request->user(), 'deactivate', $noticeType, $request->getClientIp());
        return redirect()
            ->to($request->input('redirect_to', route('admin.notice-types.edit', $noticeType->id)))
            ->with('notice', trans('notice-types.notices.deactivated', ['name' => $noticeType->name]));
    }
}
