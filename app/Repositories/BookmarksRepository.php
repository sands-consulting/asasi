<?php 

namespace App\Repositories;

use App\Bookmark;
use App\Notice;
use App\User;

class BookmarksRepository extends BaseRepository
{
    public static function add(User $user, $item)
    {
        static::create(new Bookmark, [
            'user_id' => $user->id,
            'bookmarkable_id' => $item->id,
            'bookmarkable_type' => get_class($item)
        ]);
    }

    public static function remove(User $user, Notice $notice)
    {
        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_id', $notice->id)
            ->where('bookmarkable_type', 'App\Notice')
            ->first();

        static::delete($bookmark);
    }
}