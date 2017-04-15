<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Notice;
use App\DataTables\Portal\NoticeAwardsDataTable;
use App\DataTables\Portal\NoticesDataTable;
use App\DataTables\Portal\NoticeSubmissionsDataTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function index(Request $request, NoticesDataTable $table)
    {
        return $table->render('notices.index');
    }

    public function submissions(Request $request, NoticeSubmissionsDataTable $table)
    {
        return $table->render('notices.submissions');
    }

    public function awards(Request $request, NoticeAwardsDataTable $table)
    {
        return $table->render('notices.awards');
    }

    public function show(Request $request, Notice $notice)
    {
        if(
            ($notice->invitation && $request->user() && $notice->invitations()->whereVendorId($request->user()->vendor->id)->count() == 0) ||
            ($notice->status != 'published') || 
            ($notice->published_at->gt(Carbon::now()))
        )
        {
            return redirect()->route('root');
        }

        return view('notices.show', compact('notice'));
    }

    public function bookmark(Request $request, Notice $notice)
    {
        $bookmarked = $request->user()->bookmarks()
                        ->where('bookmarkable_type', get_class($notice))
                        ->where('bookmarkable_id', $notice->id)
                        ->count() > 0;
        if($bookmarked)
        {
            return redirect()->back()->with('alert', trans('notices.alerts.bookmark'));
        }
        else
        {
            $bookmark = new Bookmark;
            $bookmark->bookmarkable()->associate($notice);
            $request->user()->bookmarks()->save($bookmark);
            return redirect()->back()->with('notice', trans('notices.notices.bookmarked'));
        }
    }
}
