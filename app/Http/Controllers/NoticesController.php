<?php

namespace App\Http\Controllers;

use App\Notice;
use App\DataTables\Portal\NoticesDataTable;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function index(Request $request, NoticesDataTable $table)
    {
        return $table->render('notices.index');
    }

    public function show(Notice $notice)
    {
        return view('notices.show', compact('notice'));
    }

    public function bookmark(Requqest $request, Notice $notice)
    {
    	$bookmarked = $request->user()->bookmarks()
    					->where('bookmarkable_type', get_class($notice))
    					->where('bookmarkable_id', $notice->id)
    					->count() > 0;
    	if($bookmarked)
    	{
    		return redirect()
    				->back()
    				->with('alert', trans('notices.flash.bookmark.alert'));
    	}
    	else
    	{
    		$request->user()->bookmarks()->save($notice);
    		return redirect()
    				->back()
    				->with('alert', trans('notices.flash.bookmark.notice'));
    	}
    }
}
