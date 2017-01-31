<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Traits\DateAccessor;

class Cart extends Model
{
    use RevisionableTrait,
        DateAccessor;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'identifier',
        'instance',
        'content'
    ];

    protected $attributes = [];

    protected $searchable = [];

    protected $sortable = [];

    protected $dates = [];

}
