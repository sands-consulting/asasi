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
        'address_1',
        'address_2',
        'address_postcode',
        'address_city_id',
        'address_state_id',
        'address_country_id',
        'contact_name',
        'contact_telephone',
        'contact_fax',
        'contact_email',
        'contact_website',
        'capital_currency',
        'capital_authorized',
        'capital_paid_up',
        'type_id',
        'user_id',
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
            foreach ($this->searchable as $column) {
                $query->orWhere($column, 'LIKE', "%$keywords%");
            }
            unset($queries['keywords']);
        }

        if (isset($queries['role']) && !empty($queries['role'])) {
            $role   = $queries['role'];
            $query->whereHas('roles', function ($roles) use ($role) {
                $roles->whereId($role);
            });
            unset($queries['role']);
        }

        foreach ($queries as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $query->orWhere($key, $value);
        }
    }

    public function scopeSort($query, $column, $direction)
    {
        if (in_array($column, $this->sortable) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($column, $direction);
        }
    }

    /*
     * Relationship
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function boot()
    {
        parent::boot();
    }
}
