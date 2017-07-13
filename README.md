# cockroachdb-laravel
CockroachDB database driver for Laravel 5.4

## Usage

### Step 1: Install Through Composer

```
composer require 'nbj/cockroachdb-laravel'
```

### Step 2: Add the Service Provider

Open `config/app.php` and, to your "providers" array, add:

```php
Nbj\Cockroach\CockroachServiceProvider::class
```

### Step 3: Add Database Driver Configuration 

Open `config/datbase.php` and, to your "connections" array, add:

```php
'cockroach' => [
    'driver' => 'cockroach',
    'host' => env('DB_HOST', 'HOSTNAME-OF-COCKROACH-SERVER'),
    'port' => env('DB_PORT', '26257'),
    'database' => env('DB_DATABASE', 'DATABASE-NAME'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'prefix' => '',
    'schema' => 'DATABASE-NAME',
    'sslmode' => 'prefer',
],
```

Make sure to update **host**, **port**, **database**, **username**, **password** and **schema** to
your configuration. Note the **database** and **schema** fields should be the same.
