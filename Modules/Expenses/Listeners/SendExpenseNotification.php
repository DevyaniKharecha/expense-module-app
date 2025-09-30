<?php

namespace Modules\Expenses\Listeners;

use Modules\Expenses\Events\ExpenseCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class SendExpenseNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ExpenseCreated $event)
    {
        $expense = $event->expense;

        // Use a simple database-notification payload
        NotificationFacade::route('database', 'system')
            ->notify(new \Modules\Expenses\Notifications\ExpenseCreatedNotification($expense));
    }
}