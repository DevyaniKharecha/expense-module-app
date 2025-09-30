<?php

namespace Modules\Expenses\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind repository after all classes exist
        $this->app->bind(
            \Modules\Expenses\Repositories\ExpenseRepositoryInterface::class,
            \Modules\Expenses\Repositories\EloquentExpenseRepository::class
        );
    }

    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
