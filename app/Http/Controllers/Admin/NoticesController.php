<?php

namespace App\Http\Controllers\Admin;

use App\Notice;
use App\DataTables\NoticesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\NoticeRequest;
use App\Repositories\NoticesRepository;
use App\Repositories\UserLogsRepository;
use Auth;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function index(NoticesDataTable $table)
    {
        return $table->render('admin.notices.index');
    }

    public function create(Request $request)
    {
        return view('admin.notices.create', ['notice' => new Notice]);
    }

    public function store(NoticeRequest $request)
    {
        $inputs = $request->only(
            'name',
            'number',
            'description',
            'price',
            'published_at',
            'expired_at',
            'purchased_at',
            'submission_at',
            'submission_address',
            'notice_type_id',
            'notice_category_id',
            'organization_id'
        );

        $notice  = NoticesRepository::create(new Notice, $inputs);
        UserLogsRepository::log(Auth::user(), 'Create', $notice, $request->getClientIp());
        return redirect()
            ->route('admin.notices.show', $notice->id)
            ->with('notice', trans('notices.notices.created', ['name' => $notice->name]));
    }

    public function show(Notice $notice)
    {
        return view('admin.notices.show', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        $requirementTechnicals = $notice->requirementTechnicals;
        $requirementCommercials = $notice->requirementCommercials;
        $noticeEvents = $notice->events;
        return view('admin.notices.edit', compact('notice', 'noticeEvents', 'requirementCommercials', 'requirementTechnicals'));
    }

    public function update(NoticeRequest $request, Notice $notice)
    {
        $inputs = $request->only(
            'name',
            'number',
            'description',
            'price',
            'published_at',
            'expired_at',
            'purchased_at',
            'submission_at',
            'submission_address',
            'notice_type_id',
            'notice_category_id',
            'organization_id',
            'status'
        );
        
        $notice  = NoticesRepository::update($notice, $inputs);
        UserLogsRepository::log(Auth::user(), 'Update', $notice, $request->getClientIp());
        return redirect()
            ->route('admin.notices.show', $notice->id)
            ->with('notice', trans('notices.notices.updated', ['name' => $notice->name]));
    }

    public function destroy(Notice $notice)
    {
        NoticesRepository::delete($notice);
        UserLogsRepository::log(Auth::user(), 'Delete', $notice, $request->getClientIp());
        return redirect()
            ->route('admin.notices.index')
            ->with('notice', trans('notices.notices.deleted', ['name' => $notice->name]));
    }

    public function logs(Notice $notice, NoticeLogsDataTable $table)
    {
        $table->setActionable($notice);
        return $table->render('admin.notices.logs', compact('notice'));
    }

    public function revisions(Notice $notice, RevisionsDataTable $table)
    {
        $table->setRevisionable($notice);
        return $table->render('admin.notices.revisions', compact('notice'));
    }

    public function publish(Request $request, Notice $notice)
    {
        NoticesRepository::publish($notice);
        UserLogsRepository::log(Auth::user(), 'Publish', $notice, $request->getClientIp());
        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)))
            ->with('notice', trans('notices.notices.published', ['name' => $notice->name]));
    }

    public function unpublish(Request $request, Notice $notice)
    {
        NoticesRepository::unpublish($notice);
        UserLogsRepository::log(Auth::user(), 'Unpublish', $notice, $request->getClientIp());
        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)))
            ->with('notice', trans('notices.notices.unpublished', ['name' => $notice->name]));
    }
}
