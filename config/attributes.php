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
        ['type' => 'string', 'cast' => 'string'],
        ['type' => 'integer', 'cast' => 'integer'],
        ['type' => 'boolean', 'cast' => 'boolean'],
        ['type' => 'date', 'cast' => 'date'],
        ['type' => 'json', 'cast' => 'array'],
    ],
];