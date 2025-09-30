<?php

namespace Modules\Expenses\Repositories;

use Modules\Expenses\Models\Expense;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentExpenseRepository implements ExpenseRepositoryInterface
{
    protected $model;

    public function __construct(Expense $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Expense
    {
        return $this->model->create($data);
    }

    public function find(string $id): ?Expense
    {
        return $this->model->find($id);
    }

    public function update(string $id, array $data): ?Expense
    {
        $expense = $this->find($id);
        if (!$expense) return null;
        $expense->update($data);
        return $expense;
    }

    public function delete(string $id): bool
    {
        $expense = $this->find($id);
        if (!$expense) return false;
        return (bool) $expense->delete();
    }

    public function all(array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['from'])) {
            $query->whereDate('expense_date', '>=', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $query->whereDate('expense_date', '<=', $filters['to']);
        }

        $perPage = $filters['per_page'] ?? 15;
        return $query->orderBy('expense_date', 'desc')->paginate($perPage);
    }
}