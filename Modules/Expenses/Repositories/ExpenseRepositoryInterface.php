<?php

namespace Modules\Expenses\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Expenses\Models\Expense;
use Ramsey\Uuid\Type\Integer;

interface ExpenseRepositoryInterface
{
    public function create(array $data): Expense;
    public function find(string $id): ?Expense;
    public function update(string $id, array $data): ?Expense;
    public function delete(string $id): bool;
    public function all(array $filters = []): LengthAwarePaginator;
}