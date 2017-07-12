<?php

namespace Nbj\Cockroach;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CockroachServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        Connection::resolverFor('cockroach', function ($connection, $database, $prefix, $config) {
            $connector = new CockroachConnector();
            $connection = $connector->connect($config);
            $db = new CockroachConnection($connection, $database, $prefix, $config);


            return $db;
        });
    }
}
