<?php

namespace Modules\Expenses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $categories = ['office', 'travel', 'food', 'misc'];

        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'category' => ['sometimes', Rule::in($categories)],
            'expense_date' => ['sometimes', 'date'],
            'notes' => ['nullable', 'string']
        ];
    }
}