<?php

namespace BalajiDharma\LaravelAttributes\Models;

use BalajiDharma\LaravelAttributes\Exceptions\AttributeValueException;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class Attribute extends Model
{
    protected $appends = ['data'];

    protected $fillable = [
        'data_type',
        'name',
        'value',
        'weight',
        'attributable_id',
        'attributable_type',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable($this->getTable());
    }

    public function getTable()
    {
        return Config::get('attributes.table_names.attributes', parent::getTable());
    }

    public function attributable()
    {
        return $this->morphTo();
    }

    protected function data(): CastsAttribute
    {
        return CastsAttribute::make(
            get: function (mixed $value, array $attributes) {
                $dataType = collect(Config::get('attributes.data_types'))->firstWhere('name', $attributes['data_type']);
                $this->casts['data'] = $dataType['cast'];

                return $this->castAttribute('data', $attributes['value']);
            }
        );
    }

    public function setValueAttribute($value)
    {
        if (Config::get('attributes.validate_value_before_save')) {
            $dataType = collect(Config::get('attributes.data_types'))->firstWhere('name', $this->data_type);

            $validator = Validator::make(['value' => $value], [
                'value' => $dataType['validation'],
            ]);

            if ($validator->fails()) {
                throw AttributeValueException::invalidValue($validator->errors()->first());
            }
        }

        $this->attributes['value'] = $value;
    }
}
