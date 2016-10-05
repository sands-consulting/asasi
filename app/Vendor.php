<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Venturecraft\Revisionable\RevisionableTrait;

class Vendor extends Authenticatable
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'registration_number',
        'tax_1_number',
        'tax_2_number',
        'contact_telephone',
        'contact_fax',
        'contact_email',
        'contact_website',
        'address_1',
        'address_2',
        'address_postcode',
        'address_city_id',
        'address_state_id',
        'address_country_id',
        'contact_person_designation',
        'contact_person_name',
        'contact_person_telephone',
        'contact_person_email',
        'capital_currency',
        'capital_authorized',
        'capital_paid_up',
        'type_id',
        'user_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'draft'
    ];

    protected $searchable = [
        'name',
        'registration_number',
        'contact_email'
    ];

    protected $sortable = [
        'name',
        'status'
    ];

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

    public function scopeAwarded($query)
    {
        return $query->whereStatus('awarded');
    }

    /* 
     * State controls 
     */
    public function canApprove()
    {
        return $this->status == 'pending' && $this->status != 'rejected';
    }

    public function canReject()
    {
        return $this->status == 'pending' && $this->status != 'rejected';
    }

    public function canSuspend()
    {
        return $this->status != 'suspended' && $this->status != 'pending';
    }

    public function canActivate()
    {
        return $this->status == 'suspended';
    }

    public function canBlacklist()
    {
        return $this->status != 'blacklisted' && $this->status != 'pending';
    }

    public function canUnblacklist()
    {
        return $this->status == 'blacklisted';
    }

    /*
     * Relationship
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function city()
    {
        return $this->belongsTo(Place::class, 'address_city_id');
    }

    public function state()
    {
        return $this->belongsTo(Place::class, 'address_state_id');
    }

    public function country()
    {
        return $this->belongsTo(Place::class, 'address_country_id');
    }

    public function notices()
    {
        return $this->belongsToMany(Notice::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /*
     * Scopes
     */
    
    public function scopeActive($query)
    {
        return $query->where('status', '=', 'active');
    }

    /*
     * Helpers 
     */

    public static function options()
    {
        return ['' => 'Select One'] + Vendor::lists('name', 'id')->toArray();
    }
    // public function getProgress($type)
    // {
    //     $progress = 0;
    //     $total = $this->submissions()->where('type', $type)->count();
    //     $completed = $this->submissions()->where('type', $type)
    //             ->wherePivot('status', 'completed')
    //             ->count();

    //     if ($total > 0) 
    //         $progress = $completed/$total * 100;

    //     return number_format($progress, 2, '.', '');

    // }

    public static function boot()
    {
        parent::boot();

        static::saving(function($model){
            foreach ($model->toArray() as $key => $value) {
                $model->{$key} = empty($value) ? null : $value;
            }
        });
    }
}
