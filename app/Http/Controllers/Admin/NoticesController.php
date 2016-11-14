<?php

namespace App\Http\Controllers\Admin;

use App\Events\NoticeAwarded;
use App\Notice;
use App\NoticeEvaluator;
use App\Project;
use App\Vendor;
use App\DataTables\NoticesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\NoticeRequest;
use App\Repositories\NoticesRepository;
use App\Repositories\ProjectsRepository;
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

        $allocations = $request->only('allocations');

        $notice  = NoticesRepository::create(new Notice, $inputs);
        UserLogsRepository::log(Auth::user(), 'Create', $notice, $request->getClientIp());
        return redirect()
            ->route('admin.notices.show', $notice->id)
            ->with('notice', trans('notices.notices.created', ['name' => $notice->name]));
    }

    public function show(Notice $notice)
    {
        $vendors = $notice->vendors;
        $submissions = $notice->submissions;
        $evaluators['commercial'] = NoticeEvaluator::where('notice_id', $notice->id)->where('type_id', 1)->get();
        $evaluators['technical'] = NoticeEvaluator::where('notice_id', $notice->id)->where('type_id', 2)->get();
        $vendorAwarded = $notice->vendors()->awarded()->first();

        return view('admin.notices.show', compact('notice', 'vendors', 'submissions', 'evaluators', 'vendorAwarded'));
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

    public function destroy(Request $request, Notice $notice)
    {
        NoticesRepository::delete($notice);
        UserLogsRepository::log(Auth::user(), 'Delete', $notice, $request->getClientIp(), $request->remarks);
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

    public function cancel(Request $request, Notice $notice)
    {
        $input = $request->only(['remarks']);
        NoticesRepository::cancel($notice);
        UserLogsRepository::log(Auth::user(), 'Cancel', $notice, $request->getClientIp(), $input['remarks']);
        return redirect()
            ->to($request->input('redirect_to', route('admin.notices.show', $notice->id)))
            ->with('notice', trans('notices.notices.cancelled', ['name' => $notice->name]));
    }

    public function summary(Notice $notice)
    {
        // Fixme: try to create dynamic query for evaluation type other than commercial and technical.
        $vendors = Vendor::leftJoin('submissions as commercials', 'commercials.vendor_id', '=', 'vendors.id')
            ->leftJoin('submissions as technicals', 'technicals.vendor_id', '=', 'vendors.id')
            ->where('commercials.notice_id', $notice->id)
            ->where('technicals.notice_id', $notice->id)
            ->where('commercials.type_id', 1)
            ->where('technicals.type_id', 2)
            ->select([
                'vendors.id',
                'vendors.name',
                'technicals.total_score as technical_score',
                'commercials.total_score as commercial_score',
                'commercials.price as offered_price',
                \DB::raw("'None' as offered_duration")
            ])
            ->groupBy('vendors.id')
            ->get();

        return view('admin.notices.evaluation-summary', compact('notice', 'vendors'));
    }

    public function award(Notice $notice, Vendor $vendor)
    {
        return view('admin.notices.award', compact('notice', 'vendor'));
    }

    public function storeAward(Request $request, Notice $notice)
    {
        $input = $request->only(['vendor_id', 'allocations', 'duration']);
        $vendor = Vendor::find($input['vendor_id']);

        $allocations = [];
        $cost = null;
        if (count($input['allocations']) > 0 ) {
            foreach($input['allocations'] as $allocation_id => $amount) {
                $allocations[$allocation_id] = [
                    'amount' => $amount,
                    'status' => 'active'
                ];

                $cost += $amount;
            }
        }

        $project = ProjectsRepository::create(new Project(), [
            'name'            => $notice->name,
            'slug'            => null,
            'number'          => $notice->number,
            'description'     => $notice->description,
            'duration'        => $input['duration'],
            'cost'            => $cost,
            'contact_name'    => $vendor->contact_person_name,
            'contact_phone'   => $vendor->contact_person_telephone,
            'contact_email'   => $vendor->contact_person_email,
            'contact_fax'     => $vendor->contact_fax,
            'organization_id' => $notice->organization_id,
            'vendor_id'       => $vendor->id,
            'notice_id'       => $notice->id,
        ]);

        $project->allocations()->sync($allocations);
        
        NoticesRepository::update($notice, ['status', 'awarded']);
        
        event(new NoticeAwarded($notice, $vendor));

        return redirect()
            ->route('admin.projects.edit', $project->id)
            ->with('notices', trans('projects.notices.create', ['number' => $project->number]));
    }
}
