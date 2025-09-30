<?php

namespace Modules\Expenses\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Modules\Expenses\Models\Expense;

class ExpenseCreatedNotification extends Notification
{
    protected $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->expense->id,
            'title' => $this->expense->title,
            'amount' => (float) $this->expense->amount,
            'category' => $this->expense->category,
            'expense_date' => $this->expense->expense_date->toDateString(),
            'message' => "New expense created: {$this->expense->title}"
        ];
    }
}