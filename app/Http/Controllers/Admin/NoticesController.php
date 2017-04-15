<?php

namespace App\Http\Controllers\Admin;

use App\EvaluationRequirement;
use App\EvaluationType;
use App\Notice;
use App\NoticeEvaluator;
use App\Project;
use App\Submission;
use App\Vendor;
use App\Events\NoticeAwarded;
use App\DataTables\EvaluationSummaryDataTable;
use App\DataTables\EvaluatorSummaryDataTable;
use App\DataTables\NoticesDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\NoticeRequest;
use App\Http\Requests\NoticeAwardRequest;
use App\Services\NoticeService;
use App\Services\ProjectService;
use App\Services\UserHistoryService;
use Auth;
use Illuminate\Http\Request;
use JavaScript;

class NoticesController extends Controller
{
    public function index(NoticesDataTable $table)
    {
        return $table->render('admin.notices.index');
    }

    public function create(Request $request)
    {
        JavaScript::put([
            'evaluationTypes' => EvaluationType::active()->get(),
            'notice' => new Notice
        ]);

        return view('admin.notices.create', ['notice' => new Notice]);
    }

    public function store(NoticeRequest $request)
    {
        $inputs = $request->only(
            'name',
            'number',
            'description',
            'rules',
            'price',
            'published_at',
            'expired_at',
            'purchased_at',
            'submission_at',
            'submission_address',
            'type_id',
            'category_id',
            'organization_id',
            'tax_code_id',
            'invitation'
        );

        if($request->user()->hasPermission('notice:organization'))
        {
            $inputs['organization_id'] = $request->user()->organization->id;
        }
        
        $notice  = NoticeService::create(new Notice, $inputs);
        NoticeService::settings($notice, $request->input('settings', []));
        NoticeService::evaluationSettings($notice, $request->input('notice-evaluations', []));
        NoticeService::events($notice, $request->input('events', []));
        NoticeService::allocations($notice, $request->input('allocations', []));
        NoticeService::qualificationCodes($notice, $request->input('qualification-codes', []));
        NoticeService::files($notice, $request->input('files', []), $request->file('files'));
        NoticeService::submissionRequirements($notice, $request->input('submission-requirements', []));
        NoticeService::evaluationRequirements($notice, $request->input('evaluation-requirements', []));
        
        UserHistoryService::log(Auth::user(), 'create', $notice, $request->getClientIp());

        return redirect()
            ->route('admin.notices.show', $notice->id)
            ->with('notice', trans('notices.notices.created', ['name' => $notice->number]));
    }

    public function show(Notice $notice)
    {
        JavaScript::put([
            'submissions' => $notice->submissions()->whereStatus('submitted')->orderBy('label')->orderBy('submitted_at')->get()
        ]);
        return view('admin.notices.show', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        JavaScript::put([
            'evaluationTypes' => EvaluationType::active()->get(),
            'notice' => $notice,
            'events' => $notice->events,
            'evaluationSettings' => $notice->evaluationSettings,
            'allocations' => $notice->allocations,
            'settings' => $notice->settings()->pluck('value', 'key'),
            'qualificationCodes' => $notice->qualificationCodes()->orderBy('group')->orderBy('sequence')->get()->groupBy('group'),
            'files' => $notice->files()->with('upload')->get(),
            'submissionRequirements' => $notice
                ->submissionRequirements()
                ->with('type')
                ->orderBy('sequence')
                ->get()
                ->groupBy(function($item, $key) {
                    return $item->type->slug;
                })->toArray(),
            'evaluationRequirements' => $notice
                ->evaluationRequirements()
                ->with('type')
                ->orderBy('sequence')
                ->get()
                ->groupBy(function($item, $key) {
                    return $item->type->slug;
                })->toArray(),
        ]);

        return view('admin.notices.edit', compact('notice'));
    }

    public function update(NoticeRequest $request, Notice $notice)
    {
        $inputs = $request->only(
            'name',
            'number',
            'description',
            'rules',
            'price',
            'published_at',
            'expired_at',
            'purchased_at',
            'submission_at',
            'submission_address',
            'type_id',
            'category_id',
            'organization_id',
            'tax_code_id',
            'invitation'
        );

        if($request->user()->hasPermission('notice:organization'))
        {
            $inputs['organization_id'] = $request->user()->organization->id;
        }
        
        $notice  = NoticeService::update($notice, $inputs);
        NoticeService::settings($notice, $request->input('settings', []));
        NoticeService::evaluationSettings($notice, $request->input('notice-evaluations', []));
        NoticeService::events($notice, $request->input('events', []));
        NoticeService::allocations($notice, $request->input('allocations', []));
        NoticeService::qualificationCodes($notice, $request->input('qualification-codes', []));
        NoticeService::files($notice, $request->input('files', []), $request->file('files'));
        NoticeService::submissionRequirements($notice, $request->input('submission-requirements', []));
        NoticeService::evaluationRequirements($notice, $request->input('evaluation-requirements', []));
        
        UserHistoryService::log(Auth::user(), 'update', $notice, $request->getClientIp());

        return redirect()
            ->route('admin.notices.show', $notice->id)
            ->with('notice', trans('notices.notices.updated', ['name' => $notice->number]));
    }

    public function destroy(Request $request, Notice $notice)
    {
        NoticeService::delete($notice);
        UserHistoryService::log(Auth::user(), 'Delete', $notice, $request->getClientIp(), $request->remarks);
        return redirect()
            ->route('admin.notices.index')
            ->with('notice', trans('notices.notices.deleted', ['name' => $notice->name]));
    }

    public function histories(Notice $notice, UserHistoriesDataTable $table)
    {
        $table->setActionable($notice);
        return $table->render('admin.notices.histories', compact('notice'));
    }

    public function revisions(Notice $notice, RevisionsDataTable $table)
    {
        $table->setRevisionable($notice);
        return $table->render('admin.notices.revisions', compact('notice'));
    }

    public function publish(Request $request, Notice $notice)
    {
        NoticeService::publish($notice);
        UserHistoryService::log(Auth::user(), 'Publish', $notice, $request->getClientIp());
        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)))
            ->with('notice', trans('notices.notices.published', ['name' => $notice->name]));
    }

    public function unpublish(Request $request, Notice $notice)
    {
        NoticeService::unpublish($notice);
        UserHistoryService::log(Auth::user(), 'Unpublish', $notice, $request->getClientIp());
        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)))
            ->with('notice', trans('notices.notices.unpublished', ['name' => $notice->name]));
    }

    public function cancel(Request $request, Notice $notice)
    {
        $input = $request->only(['remarks']);
        NoticeService::cancel($notice);
        UserHistoryService::log(Auth::user(), 'Cancel', $notice, $request->getClientIp(), $input['remarks']);
        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)))
            ->with('notice', trans('notices.notices.cancelled', ['name' => $notice->name]));
    }

    public function eligible(Request $request, Notice $notice)
    {
        $inputs = $request->only('vendor_id', 'remarks');
        $inputs['exception'] = 1;

        if($notice->eligibles()->whereVendorId($inputs['vendor_id'])->count() > 0)
        {
            return redirect()
                ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)) . '#tab-notice-eligibles')
                ->with('notice', trans('notices.alerts.eligible'));
        }

        $eligible = $notice->eligibles()->create($inputs);

        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)) . '#tab-notice-eligibles')
            ->with('notice', trans('notices.notices.eligible', ['name' => $eligible->vendor->name]));
    }

    public function invitation(Request $request, Notice $notice)
    {
        $vendorIds = $request->input('vendor_ids', []);

        if(count($vendorIds) == 0)
        {
            return redirect()
                ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)) . '#tab-notice-invitations')
                ->with('notice', trans('notices.alerts.invitation'));
        }

        foreach($vendorIds as $vendorId)
        {
            $notice->invitations()->firstOrCreate(['vendor_id' => $vendorId]);
        }

        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)) . '#tab-notice-invitations')
            ->with('notice', trans('notices.notices.invitation'));
    }

    public function award(NoticeAwardRequest $request, Notice $notice)
    {
        $award = NoticeService::award($notice, $request->only('submission_id', 'price', 'period'));
        return redirect(route('admin.notices.show', $notice->id) . '#tab-notice-award')
            ->with('notice', trans('notices.notices.awarded', ['name' => $award->vendor->name]));
    }
}
