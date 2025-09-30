Expense Management Module (Laravel 12)

A modular Expense Management system built with Laravel 12.
This project demonstrates clean architecture with service layers, repository pattern, API routes, events, and form request validation — suitable for ERP-style backend development.

📌 Features

✅ Modular structure under Modules/Expenses

✅ CRUD operations for expenses:

Create, View all, Update, Delete

✅ UUID primary keys

✅ Service layer for business logic

✅ Repository pattern for data access

✅ Form Request validation

✅ Laravel API Resources for consistent response formatting

✅ Event (ExpenseCreated)

✅ Optional filters (category, date range)

✅ Works with SQLite (no MySQL required)

⚙️ Requirements

PHP 8.2+

Composer 2+

Laravel 12.x

SQLite (default for this setup)

🚀 Setup Instructions
1. Clone the repo
git clone https://github.com/your-username/my-expense-app.git
cd my-expense-app

2. Install dependencies
composer install

3. Create environment file
cp .env.example .env
php artisan key:generate


Update .env to use SQLite:

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/project/database/database.sqlite


Then create the SQLite file:

touch database/database.sqlite

4. Run migrations
php artisan migrate


If you already created tables before:

php artisan migrate:fresh

5. Register module provider

Open bootstrap/providers.php and add:

Modules\Expenses\Providers\ModuleServiceProvider::class,

6. Start server
php artisan serve


Laravel will run on:

http://127.0.0.1:8000

📡 API Endpoints

Base URL:

http://127.0.0.1:8000/api

Endpoints
Method	Endpoint	Description
GET	/expenses	List all expenses
POST	/expenses	Create expense
GET	/expenses/{id}	View expense
PUT	/expenses/{id}	Update expense
DELETE	/expenses/{id}	Delete expense
📝 Example Requests
Create Expense

POST /api/expenses
Body (JSON):

{
  "title": "Taxi ride",
  "amount": 25.50,
  "category": "travel",
  "expense_date": "2025-09-30",
  "notes": "From airport to hotel"
}


Response (201):

{
  "data": {
    "id": "e036c75f-0140-4a45-9ffb-93ea842267b9",
    "title": "Taxi ride",
    "amount": "25.50",
    "category": "travel",
    "expense_date": "2025-09-30",
    "notes": "From airport to hotel",
    "created_at": "2025-09-30T12:07:14.000000Z"
  }
}

🏗️ Project Structure
Modules/
 └── Expenses/
     ├── Database/
     │   └── Migrations/ (expenses table migration)
     ├── Http/
     │   ├── Controllers/ (ExpenseController.php)
     │   └── Requests/ (StoreExpenseRequest.php, UpdateExpenseRequest.php)
     ├── Models/ (Expense.php)
     ├── Providers/ (ModuleServiceProvider.php)
     ├── Repositories/ (EloquentExpenseRepository.php, ExpenseRepositoryInterface.php)
     ├── Resources/ (ExpenseResource.php)
     ├── Routes/ (api.php)
     ├── Services/ (ExpenseService.php)
     └── Events/ (ExpenseCreated.php)

⏱️ Time Spent

Setup & module scaffolding: 1 hour

CRUD implementation: 3.5 hours

Service layer + repository: 2.5 hours

Events + resources: 2 hours

README & docs: 1 hour

Total: 10 hours

✅ Assumptions

No authentication/user handling (per requirements)

Categories are handled via enum/string (not a separate module)

SQLite is used for simplicity (but Eloquent is DB-agnostic)

