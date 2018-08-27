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
    'sslcert' => env('DB_SSLCERT', '/root/client.root.crt'),
    'sslkey' => env('DB_SSLKEY', '/root/client.root.key'),
    'sslrootcert' => env('DB_SSLROOTCERT', '/root/ca.crt'),
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
