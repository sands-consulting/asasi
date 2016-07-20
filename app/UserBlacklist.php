<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Venturecraft\Revisionable\RevisionableTrait;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class UserBlacklist extends Model implements SluggableInterface
{
    use RevisionableTrait;

    protected $fillable = [
        'reason',
        'user_id',
        'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
