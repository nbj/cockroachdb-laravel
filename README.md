# cockroachdb-laravel
CockroachDB database driver for Laravel 5

## Usage

### Step 1: Install Through Composer

```
composer require nbj/cockroachdb-laravel
```

### Step 2: Add the Service Provider (This happens automatically in Laravel 5.5) 

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
    
    // Only set these keys if you want to run en secure mode
    // otherwise you can them out of the configuration array
    'sslcert' => env('DB_SSLCERT', 'client.crt'),
    'sslkey' => env('DB_SSLKEY', 'client.key'),
    'sslrootcert' => env('DB_SSLROOTCERT', 'ca.crt'),
],
```

Make sure to update **host**, **port**, **database**, **username**, **password** and **schema** to
your configuration. Note the **database** and **schema** fields should be the same.

## Secure Mode

Update **sslcert**, **sslkey** and **sslrootcert** with your path configuration.

## CockroachDB 2

Changes made to CockroachDB handles schemas slightly
different when using the PHP Postgres driver. So instead of using:
```
'schema' => 'DATABASE-NAME'
```
We need to use the Postgres default of `public` so change your config
to:
```
'schema' => 'public'
```
And everything should work as expected.

## Usage without laravel
It is entirely possible to use this driver without the entire Laravel framework.
Laravel's database components are neatly packaged in its own composer package
called `illuminate/database` Simply require this package into your project, and
you are ready to go.
```
composer require illuminate/database
composer require nbj/cockroachdb-laravel
```

To set up a database connection you need to create a new `Capsule` and register it.
```php
<?php

use Illuminate\Database\Connection;
use Nbj\Cockroach\CockroachConnector;
use Nbj\Cockroach\CockroachConnection;
use Illuminate\Database\Capsule\Manager as DB;

require 'vendor/autoload.php';

$config = [
    // Your configuration goes here
];

// Add connection resolver for the cockroach driver
Connection::resolverFor('cockroach', function ($connection, $database, $prefix, $config) {
    $connection = (new CockroachConnector)->connect($config);

    return new CockroachConnection($connection, $database, $prefix, $config);
});

// Create a new DatabaseManager instance
$db = new DB;

// Add a connection using your configuration
$db->addConnection($config);

// Register the DatabaseManager instance as global
$db->setAsGlobal();
```

It is even possible to use Eloquent (Laravel's ORM) if you choose to. Simply add:
```php
$db->bootEloquent();
```

By this point you are able to use the globally registered DatabaseManager like this:
```php
<?php

use Illuminate\Database\Capsule\Manager as DB;

require 'vendor/autoload.php';

// Fetch all users from the users table
$users = DB::table('users')->get();
```

