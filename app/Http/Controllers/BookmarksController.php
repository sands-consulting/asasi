<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\BookmarksRepository;
use Bookmark;

class BookmarksController extends Controller
{
    public function index()
    {
        $contents = Bookmark::content();
        return view()->make('bookmarks.index', compact('contents'));
    }

    public function add(Request $request, $item)
    {
        $bookmark = BookmarksRepository::add($request->user(), $item);

        return redirect()
            ->back()
            ->with('notice', trans('bookmarks.notices.added', ['name' => $item->name]));
    }

    public function remove($id)
    {
        $item = Bookmark::get($id);
        Bookmark::destroy($id);
        return redirect()
            ->route('bookmarks.index')
            ->with('notice', trans('bookmark.notices.removed', ['name' => $item->name]));
    }

    public function destroy()
    {
        Bookmark::destroy();
    }
}
