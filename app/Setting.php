<?php namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key',
        'value'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function item()
    {
        return $this->morphTo();
    }
}
