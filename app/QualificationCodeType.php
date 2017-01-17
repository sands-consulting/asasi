<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class QualificationCodeType extends Node
{
    use RevisionableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'parent_id',
        'type',
        'code'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public $types = [
        'list',
        'boolean'
    ];

    public function codes()
    {
        return $this->hasMany(QualificationCode::class, 'type_id');
    }

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }


    public function scopeActiveCodes($query)
    {
        return $query->whereHas('codes', function($codes) {
            return $codes->whereStatus('active');
        });
    }

    public static function getOptions($column, $key = null, $seperator = ' ') {
        $instance = new static;
        $key = $key ?: $instance->getKeyName();
        $depthColumn = $instance->getDepthColumnName();
        $nodes = $instance->newNestedSetQuery()->get()->toArray();
        
        $options = array_combine(
            array_map(function($node) use($key) {
                return $node[$key];
            }, $nodes),

            array_map(function($node) use($seperator, $depthColumn, $column) {
                return str_repeat($seperator, $node[$depthColumn]) . ' ' . $node[$column];
            }, $nodes)
        );

        return ['' => ''] + $options;
  }
}
