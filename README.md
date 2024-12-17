<h1 align="center">Laravel Attributes</h1>
<h3 align="center">Track Page views for your Laravel projects.</h3>
<p align="center">
<a href="https://packagist.org/packages/balajidharma/laravel-attributes"><img src="https://poser.pugx.org/balajidharma/laravel-attributes/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-attributes"><img src="https://poser.pugx.org/balajidharma/laravel-attributes/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-attributes"><img src="https://poser.pugx.org/balajidharma/laravel-attributes/license" alt="License"></a>
</p>

## Credits
This package builds upon the work done in [milwad-dev/laravel-attributes](https://github.com/milwad-dev/laravel-attributes) and has been modified to suit specific needs. We are grateful to the original author and contributors for their work.

## Features
- Track page views for Laravel Eloquent models
- Configure unique views by IP, session, and authenticated users
- Bot detection and filtering
- Support for DNT (Do Not Track) header
- Configurable view counting and storage

## Table of Contents

- [Installation](#installation)
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

- Recording views
To make a view record, you can call the record method.
```php
public function show(Thread $thread)
{
    $thread->record();
    
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

Defines the model class used for tracking views. You can override this with your own model class if needed.

```php
'table_names' => [
    'attributes' => 'views',
],
```
Specifies the database table name used for storing views. Default is 'views'.

### Bot Detection

```php
'ignore_bots' => true,
```

- `true`: Ignores views from bots and crawlers
- `false`: Records views from all visitors including bots
- Default: `true`

### Do Not Track (DNT) Header

```php
'honor_dnt' => false,
```
- `true`: Respects the Do Not Track (DNT) header from browsers
- `false`: Records views regardless of DNT header
- Default: `false`

### Unique View Settings

```php
'unique_ip' => true,
'unique_session' => true,
'unique_viewer' => true,
```
Controls how unique views are tracked:

- `unique_ip`: Records only one view per IP address
- `unique_session`: Records only one view per session
- `unique_viewer`: Records only one view per authenticated user
- Default: All set to `true`

### Model View Counter

```php
'increment_model_view_count' => false,
'increment_model_column_name' => 'view_count',
```
- `increment_model_view_count`: Enable/disable automatic view count increment on the model
- `increment_model_column_name`: Specifies the column name for storing view count
- Default: Counter disabled, column name set to 'view_count'

### IP Address Filtering
```php
'ignored_ip_addresses' => [
    //'127.0.0.1',
],
```
- Array of IP addresses to ignore when recording views
- Views from these IPs will not be recorded
- Default: Empty array (no IPs ignored)

## Control configuration on model

You able to control all the configurtion on model, by adding below properties 

```php
<?php
namespace BalajiDharma\LaravelForum\Models;

use BalajiDharma\LaravelAttributes\Traits\HasAttributes;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasAttributes;

    protected $ignore_bots = true;

    protected $honor_dnt = true;

    protected $unique_session = false;

    protected $unique_ip = false;

    protected $unique_viewer = false;

    protected $increment_model_view_count = true;

    protected $increment_model_column_name = 'view_count';

    protected $ignored_ip_addresses = [
        '127.0.0.1',
        '0.0.0.0'
    ]

```


## Demo
The "[Basic Laravel Admin Penel](https://github.com/balajidharma/basic-laravel-admin-panel)" starter kit come with Laravel Attributes
