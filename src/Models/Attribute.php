<?php

namespace Balajidharma\LaravelAttributes\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'data_type',
        'name',
        'value',
        'attributable_id',
        'attributable_type'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable($this->getTable());
    }

    public function getTable()
    {
        return config('attributes.table_names.attributes', parent::getTable());
    }

    public function attributable()
    {
        return $this->morphTo();
    }
}