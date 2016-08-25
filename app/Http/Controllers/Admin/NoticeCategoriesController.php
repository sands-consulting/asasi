<?php

namespace App\Http\Controllers\Admin;

use App\NoticeCategory;
use App\DataTables\NoticeCategoriesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\NoticeCategoryRequest;
use App\Repositories\NoticeCategoriesRepository;
use Illuminate\Http\Request;

class NoticeCategoriesController extends Controller
{
    public function index(NoticeCategoriesDataTable $table)
    {
        return $table->render('admin.notice-categories.index');
    }

    public function create(Request $request)
    {
        return view('admin.notice-categories.create', ['noticeCategory' => new NoticeCategory]);
    }

    public function store(NoticeCategoryRequest $request)
    {
        $inputs = $request->only('name');

        $noticeCategory  = NoticeCategoriesRepository::create(new NoticeCategory, $inputs);
        return redirect()
            ->route('admin.notice-categories.show', $noticeCategory->id)
            ->with('notice', trans('notice-categories.notices.created', ['name' => $noticeCategory->name]));
    }

    public function show(NoticeCategory $noticeCategory)
    {
        return view('admin.notice-categories.show', compact('noticeCategory'));
    }

    public function edit(NoticeCategory $noticeCategory)
    {
        return view('admin.notice-categories.edit', compact('noticeCategory'));
    }

    public function update(NoticeCategoryRequest $request, NoticeCategory $noticeCategory)
    {
        $inputs = $request->only(
            'name'
        );
        
        $noticeCategory  = NoticeCategoriesRepository::update($noticeCategory, $inputs);
        return redirect()
            ->route('admin.notice-categories.show', $noticeCategory->id)
            ->with('notice', trans('notice-categories.notices.updated', ['name' => $noticeCategory->name]));
    }

    public function destroy(NoticeCategory $noticeCategory)
    {
        NoticeCategoriesRepository::delete($noticeCategory);
        return redirect()
            ->route('admin.notice-categories.index')
            ->with('notice', trans('notice-categories.notices.deleted', ['name' => $noticeCategory->name]));
    }

    public function logs(NoticeCategory $noticeCategory, NoticeCategoryLogsDataTable $table)
    {
        $table->setActionable($noticeCategory);
        return $table->render('admin.notice-categories.logs', compact('noticeCategory'));
    }

    public function revisions(NoticeCategory $noticeCategory, RevisionsDataTable $table)
    {
        $table->setRevisionable($noticeCategory);
        return $table->render('admin.notice-categories.revisions', compact('noticeCategory'));
    }

    public function activate(Request $request, NoticeCategory $noticeCategory)
    {
        NoticeCategoriesRepository::activate($noticeCategory);
        return redirect()
            ->to($request->input('redirect_to', route('admin.notice-categories.show', $noticeCategory->id)))
            ->with('notice', trans('notice-categories.notices.activated', ['name' => $noticeCategory->name]));
    }

    public function deactivate(Request $request, NoticeCategory $noticeCategory)
    {
        NoticeCategoriesRepository::deactivate($noticeCategory);
        return redirect()
            ->to($request->input('redirect_to', route('admin.notice-categories.show', $noticeCategory->id)))
            ->with('notice', trans('notice-categories.notices.deactivated', ['name' => $noticeCategory->name]));
    }
}
