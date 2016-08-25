<?php

namespace App\Http\Controllers\Admin;

use App\NoticeType;
use App\DataTables\NoticeTypesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\NoticeTypeRequest;
use App\Repositories\NoticeTypesRepository;
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

        $noticeType  = NoticeTypesRepository::create(new NoticeType, $inputs);
        return redirect()
            ->route('admin.notice-types.show', $noticeType->id)
            ->with('notice', trans('notice-types.notices.created', ['name' => $noticeType->name]));
    }

    public function show(NoticeType $noticeType)
    {
        return view('admin.notice-types.show', compact('noticeType'));
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
        
        $noticeType  = NoticeTypesRepository::update($noticeType, $inputs);
        return redirect()
            ->route('admin.notice-types.show', $noticeType->id)
            ->with('notice', trans('notice-types.notices.updated', ['name' => $noticeType->name]));
    }

    public function destroy(NoticeType $noticeType)
    {
        NoticeTypesRepository::delete($noticeType);
        return redirect()
            ->route('admin.notice-types.index')
            ->with('notice', trans('notice-types.notices.deleted', ['name' => $noticeType->name]));
    }

    public function logs(NoticeType $noticeType, NoticeTypeLogsDataTable $table)
    {
        $table->setActionable($noticeType);
        return $table->render('admin.notice-types.logs', compact('noticeType'));
    }

    public function revisions(NoticeType $noticeType, RevisionsDataTable $table)
    {
        $table->setRevisionable($noticeType);
        return $table->render('admin.notice-types.revisions', compact('noticeType'));
    }

    public function activate(Request $request, NoticeType $noticeType)
    {
        NoticeTypesRepository::activate($noticeType);
        return redirect()
            ->to($request->input('redirect_to', route('admin.notice-types.show', $noticeType->id)))
            ->with('notice', trans('notice-types.notices.activated', ['name' => $noticeType->name]));
    }

    public function deactivate(Request $request, NoticeType $noticeType)
    {
        NoticeTypesRepository::deactivate($noticeType);
        return redirect()
            ->to($request->input('redirect_to', route('admin.notice-types.show', $noticeType->id)))
            ->with('notice', trans('notice-types.notices.deactivated', ['name' => $noticeType->name]));
    }
}
