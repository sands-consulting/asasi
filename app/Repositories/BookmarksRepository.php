<?php 

namespace App\Repositories;

use App\Bookmark;
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
}