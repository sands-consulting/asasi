<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Vendor extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'registration_number',
        'normalized_registration_number',
        'tax_1_number',
        'tax_2_number',
        'contact_telephone',
        'contact_fax',
        'contact_email',
        'contact_website',
        'contact_person_title',
        'contact_person_name',
        'contact_person_telephone',
        'contact_person_email',
        'capital_currency',
        'capital_authorized',
        'capital_paid_up',
        'type_id',
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
        if (isset($queries['keywords']) && !empty($queries['keywords']))
        {
            $keywords = $queries['keywords'];
            $query->where(function($query) use($keywords) {
                foreach ($this->searchable as $column) {
                    $query->orWhere("{$this->getTable()}.{$column}", 'LIKE', "%$keywords%");
                }
            });
            unset($queries['keywords']);
        }

        foreach ($queries as $key => $value)
        {
            if (empty($value))
            {
                continue;
            }
            
            $query->where("{$this->getTable()}.{$key}", $value);
        }
    }

    public function scopeSort($query, $column, $direction)
    {
        if (in_array($column, $this->sortable) && in_array($direction, ['asc', 'desc']))
        {
            $query->orderBy($column, $direction);
        }
    }

    public function scopeAccepted($query)
    {
        return $query->whereStatus('accepted');
    }

    public function scopeActive($query)
    {
        return $query->whereStatus('active');
    }

    public function scopeBlacklisted($query)
    {
        return $query->whereStatus('blacklisted');
    }

    public function scopeDraft($query)
    {
        return $query->whereStatus('draft');
    }

    public function scopeInactive($query)
    {
        return $query->whereStatus('inactive');
    }

    public function scopeRejected($query)
    {
        return $query->whereStatus('rejected');
    }

    /*
     * Relationship
     */

    public function logs()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'item');
    }

    public function type()
    {
        return $this->belongsTo(VendorType::class, 'type_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function accounts()
    {
        return $this->hasMany(VendorAccount::class);
    }

    public function employees()
    {
        return $this->hasMany(VendorEmployee::class);
    }

    public function files()
    {
        return $this->hasMany(VendorFile::class);
    }

    public function shareholders()
    {
        return $this->hasMany(VendorShareholder::class);
    }

    public function qualifications()
    {
        return $this->hasMany(VendorQualification::class);
    }

    public function transactions()
    {
        return $this->morphMany(Subscription::class, 'payer');
    }

    public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscriber');
    }

    public function eligibles()
    {
        return $this->hasMany(NoticeEligible::class);
    }

    public function invitations()
    {
        return $this->hasMany(NoticeEligible::class);
    }

    public function purchases()
    {
        return $this->hasMany(NoticePurchase::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /*
     * Scopes
     */
    
    public function getActiveSubscriptionAttribute()
    {
        return $this->subscriptions()->active()->first();
    }

    public static function options()
    {
        return Vendor::pluck('name', 'id')->toArray();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->normalized_registration_number = normalize_registration_number($model->registration_number);
        });

        static::saving(function($model){
            foreach($model->getFillable() as $attribute) {
                $model->{$attribute} = !empty($model->{$attribute}) ? $model->{$attribute} : null;
            }
        });
    }
}
