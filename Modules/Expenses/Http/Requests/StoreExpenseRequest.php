<?php

namespace Modules\Expenses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // always true as no auth required
    }

    public function rules()
    {
        $categories = ['office', 'travel', 'food', 'misc']; // choices

        return [
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'category' => ['required', Rule::in($categories)],
            'expense_date' => ['required', 'date'],
            'notes' => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'category.in' => 'Category must be one of: office, travel, food, misc.'
        ];
    }
}