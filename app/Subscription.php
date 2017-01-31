<?php namespace App;

use App\Traits\DateAccessor;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Venturecraft\Revisionable\RevisionableTrait;

class Subscription extends Authenticatable
{
    use RevisionableTrait,
        SoftDeletes,
        DateAccessor;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'started_at',
        'expired_at',
        'vendor_id',
        'package_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $searchable = [
    ];

    protected $sortable = [
        'started_at',
        'expired_at',
        'status'
    ];

    protected $dates = ['started_at', 'expired_at'];

    /*
     * Search scopes
     */

    public function scopeSearch($query, $queries = [])
    {
        if (isset($queries['keywords']) && !empty($queries['keywords'])) {
            $keywords = $queries['keywords'];
            $query->where(function($query) use($keywords) {
                foreach ($this->searchable as $column) {
                    $query->orWhere("{$this->getTable()}.{$column}", 'LIKE', "%$keywords%");
                }
            });
            unset($queries['keywords']);
        }

        foreach ($queries as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $query->where("{$this->getTable()}.{$key}", $value);
        }
    }

    public function scopeSort($query, $column, $direction)
    {
        if (in_array($column, $this->sortable) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($column, $direction);
        }
    }

    /*
     * Query scopes
     */
    
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /* 
     * State controls 
     */
    public function canActivate()
    {
        return $this->status == 'inactive' || $this->status == 'cancelled' ;
    }

    public function canDeactivate()
    {
        return $this->status == 'active';
    }

    public function canCancel()
    {
        return $this->status != 'cancelled';
    }
    
    /*
     * Relationship
     */

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public static function boot()
    {
        parent::boot();
    }

    public function getExpiringAttribute()
    {
        $compare = $this->expired_at->subMonths(3);
        return $compare->freshTimestamp()->gte($compare);
    }

    public function getExpiredAttribute()
    {
        return $compare->freshTimestamp()->gt($this->expired_at);
    }

}
