<?php

namespace App\Providers;

use App\Models\Data;
use App\Models\TableSchema;
use App\Policies\DataPolicy;
use App\Policies\TableSchemaPolicy;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registering policies
     * @var array
     */
    protected $policies = [
        Data::class => DataPolicy::class,
        TableSchema::class => TableSchemaPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
