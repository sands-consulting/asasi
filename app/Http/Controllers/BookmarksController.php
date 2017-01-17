<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Http\Requests;
use App\Notice;
use App\Repositories\BookmarksRepository;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    public function index(Request $request)
    {
        $contents = $request->user()->bookmarks;
        return view()->make('bookmarks.index', compact('contents'));
    }

    public function add(Request $request, $item)
    {
        $bookmark = BookmarksRepository::add($request->user(), $item);

        return redirect()
            ->back()
            ->with('notice', trans('bookmarks.notices.added', ['name' => $item->name]));
    }

    public function remove(Request $request, Notice $notice)
    {
        BookmarksRepository::remove($request->user(), $notice);
        return redirect()
            ->back()
            ->with('notice', trans('bookmarks.notices.removed', ['name' => $notice->number]));
    }

    public function destroy()
    {
        Bookmark::destroy();
    }
}
