<?php

return [
    'models' => [
        'attributes' => BalajiDharma\LaravelAttributes\Models\Attribute::class,
    ],

    'table_names' => [
        'attributes' => 'attributes',
    ],

    'validate_value_before_save' => true,

    'data_types' => [
        ['type' => 'string', 'validation' => 'string', 'cast' => 'string'],
        ['type' => 'integer', 'validation' => 'integer', 'cast' => 'integer'],
        ['type' => 'float', 'validation' => 'numeric', 'cast' => 'float'],
        ['type' => 'boolean', 'validation' => 'boolean', 'cast' => 'boolean'],
        ['type' => 'date', 'validation' => 'date', 'cast' => 'date'],
        ['type' => 'json', 'validation' => 'json', 'cast' => 'array'],
    ],
];