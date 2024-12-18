<h1 align="center">Laravel Attributes</h1>
<h3 align="center">Add custom attribute to you Laravel model.</h3>
<p align="center">
<a href="https://packagist.org/packages/balajidharma/laravel-attributes"><img src="https://poser.pugx.org/balajidharma/laravel-attributes/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-attributes"><img src="https://poser.pugx.org/balajidharma/laravel-attributes/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-attributes"><img src="https://poser.pugx.org/balajidharma/laravel-attributes/license" alt="License"></a>
</p>

## Credits
This package builds upon the work done in [milwad-dev/laravel-attributes](https://github.com/milwad-dev/laravel-attributes) and has been modified to suit specific needs. We are grateful to the original author and contributors for their work.

## Features
- Save attribute with data type
- Attribute with sort orders
- Attribute casting

## Table of Contents

- [Installation](#installation)
- [Save Attrubute](#save-attribute)
- [Get Attributes]($get-attributes)
- [Configuration](#configuration-options)
- [Demo](#demo)

## Installation
- Install the package via composer
```bash
composer require balajidharma/laravel-attributes
```

- Publish the migration with
```bash
php artisan vendor:publish --provider="BalajiDharma\LaravelAttributes\AttributesServiceProvider" --tag="migrations"
```

- Run the migration
```bash
php artisan migrate
```

- To Publish the config/attributes.php config file with
```bash
php artisan vendor:publish --provider="BalajiDharma\LaravelAttributes\AttributesServiceProvider" --tag="config"
```

- Preparing your model
To associate views with a model, the model must implement the HasAttributes trait:
```php
<?php
namespace BalajiDharma\LaravelForum\Models;

use BalajiDharma\LaravelAttributes\Traits\HasAttributes;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasAttributes;
	
```
## Save attribute

- Save single attibute

```php
$thread->save();

$thread->attachAttribute('color', 'red');

```

- Save single attibute with data type
```php

$thread->attachAttribute('color', 'red', 'string');

$thread->attachAttribute('price', '10', 'integer');

$thread->attachAttribute('is_active', '1', 'boolean');

```
default data type is `string`

- Save single attibute with weight

The weight used to sort the attributes

```php

$thread->attachAttribute('color', 'red', 'string', 1);

$thread->attachAttribute('price', '10', 'integer', 2);

$thread->attachAttribute('is_active', '1', 'boolean', 3);

```
default weight value is `0`


- Save multiple attibute

```php
$data = [
    [
        'name' => 'color',
        'value' => 'red',
        'data_type' => 'string'
    ],
    [
        'name' => 'price',
        'value' => '10',
        'data_type' => 'interger'
    ],
    [
        'name' => 'is_active',
        'value' => '1',
        'data_type' => 'boolean'
    ],
]

$thread->attachAttributes($data);

```
`weight` will be added based on array index

## Get Attributes

- Get attributes with query
```php
$thread = Thread::query()->with('attributes')->get();

$thread->attributes;
```

- Check attribute value is exists

```php
if ($thread->hasAttributeValue('red')) {
    return 'attribute value';
}

return 'no attribute value';
```

- Check attribute name is exists

```php
if ($thread->hasAttributName('color')) {
    return 'attribute name';
}

return 'no attribute name';
```

- Delete all attributes

```php
$thread->deleteAllAttribute();
```

- Delete attribute by name and value

```php
$thread->deleteAttribute('color', 'red');
```

- Delete attribute by name

```php
$thread->deleteAttributeByName('color');
```

- Delete attribute by value

```php
$thread->deleteAttributeByValue('red');
```

# Laravel Attributes Configuration

This document describes all configuration options available in the `attributes.php` config file.

## Configuration Options

### Models

```php
'models' => [
    'attributes' => BalajiDharma\LaravelAttributes\Models\Attributes::class,
],
```

Defines the model class used to save attributes. You can override this with your own model class if needed.

```php
'table_names' => [
    'attributes' => 'attributes',
],
```
Specifies the database table name used for storing attributes. Default is 'attributes'.

### Data Type and Casting

```php
'data_types' => [
    [
        'type' => 'string',
        'cast' => 'string',
    ],
    [
        'type' => 'integer',
        'cast' => 'integer',
    ],
    [
        'type' => 'boolean',
        'cast' => 'boolean',
    ],
    [
        'type' => 'date',
        'cast' => 'date',
    ],
    [
        'type' => 'json',
        'cast' => 'array',
    ],
],
```

## Demo
The "[Basic Laravel Admin Penel](https://github.com/balajidharma/basic-laravel-admin-panel)" starter kit come with Laravel Attributes
