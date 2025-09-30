<?php

namespace Modules\Expenses\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Expenses\Services\ExpenseService;
use Modules\Expenses\Http\Requests\StoreExpenseRequest;
use Modules\Expenses\Http\Requests\UpdateExpenseRequest;
use Modules\Expenses\Http\Resources\ExpenseResource;
use Modules\Expenses\Http\Resources\ExpenseCollection;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{
    protected $service;

    public function __construct(ExpenseService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['category', 'from', 'to', 'per_page']);
        $expenses = $this->service->getAll($filters);
        return (new ExpenseCollection($expenses))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = $this->service->create($request->validated());
        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $expense = $this->service->get($id);
        if (!$expense) {
            return response()->json(['message' => 'Expense not found.'], Response::HTTP_NOT_FOUND);
        }
        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateExpenseRequest $request, $id)
    {
        $expense = $this->service->update($id, $request->validated());
        if (!$expense) {
            return response()->json(['message' => 'Expense not found.'], Response::HTTP_NOT_FOUND);
        }
        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Expense not found.'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}