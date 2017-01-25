<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Http\Requests;
use App\Notice;
use App\Services\BookmarksService;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $bookmark = BookmarksService::add($request->user(), $item);
        return redirect()
            ->back()
            ->with('notice', trans('bookmarks.notices.added', ['name' => $item->name]));
    }

    public function destroy(Request $request)
    {
        BookmarksService::remove($request->user(), $notice);
        return redirect()
            ->back()
            ->with('notice', trans('bookmarks.notices.removed', ['name' => $notice->number]));
    }
}