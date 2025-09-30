<?php

namespace Modules\Expenses\Services;

use Modules\Expenses\Repositories\ExpenseRepositoryInterface;
use Modules\Expenses\Models\Expense;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Expenses\Events\ExpenseCreated;

class ExpenseService
{
    protected $repo;

    public function __construct(ExpenseRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data): Expense
    {
        $expense = $this->repo->create($data);

        // execute event
        event(new ExpenseCreated($expense));

        return $expense;
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->repo->all($filters);
    }

    public function get(string $id): ?Expense
    {
        return $this->repo->find($id);
    }

    public function update(string $id, array $data): ?Expense
    {
        return $this->repo->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}