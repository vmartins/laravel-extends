<?php

namespace Vmartins\LaravelExtends\App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;
use Vmartins\LaravelExtends\Illuminate\Database\SQLiteConnection;
use Vmartins\LaravelExtends\Illuminate\Database\MySqlConnection;
use Vmartins\LaravelExtends\Illuminate\Database\PostgresConnection;
use Vmartins\LaravelExtends\Illuminate\Database\SqlServerConnection;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        Connection::resolverFor('sqlite', function ($connection, $database, $prefix, $config) {
            return new SQLiteConnection($connection, $database, $prefix, $config);
        });

        Connection::resolverFor('mysql', function ($connection, $database, $prefix, $config) {
            return new MySqlConnection($connection, $database, $prefix, $config);
        });

        Connection::resolverFor('pgsql', function ($connection, $database, $prefix, $config) {
            return new PostgresConnection($connection, $database, $prefix, $config);
        });

        Connection::resolverFor('sqlsrv', function ($connection, $database, $prefix, $config) {
            return new SqlServerConnection($connection, $database, $prefix, $config);
        });
    }
}
