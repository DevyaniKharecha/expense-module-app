<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Modules\Expenses\Events\ExpenseCreated::class => [
            \Modules\Expenses\Listeners\SendExpenseNotification::class,
        ],
    ];
}