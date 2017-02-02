<?php 

namespace App\Services;

use App\Bookmark;
use App\User;

class BookmarkService
{
    public static function add(User $user, $item)
    {
        static::create(new Bookmark, [
            'user_id' => $user->id,
            'bookmarkable_id' => $item->id,
            'bookmarkable_type' => get_class($item)
        ]);
    }

    public static function remove(User $user, $item)
    {
        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_id', $item->id)
            ->where('bookmarkable_type', get_class($item))
            ->first();

        static::delete($bookmark);
    }
}
