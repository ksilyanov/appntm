<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.log_query_on', false)) {
            \DB::listen(function ($query): void {
                file_put_contents(
                    storage_path('logs/').'db_query.log',
                    'Query: '.var_export([
                        $query->sql,
                        $query->bindings,
                        $query->time,
                    ], true).PHP_EOL,
                    FILE_APPEND
                );
            });
        }
    }
}
