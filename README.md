# Project & Task Management App

Simple Laravel application to manage **Projects and Tasks**.

## Features Completed

* User authentication (Laravel Breeze)
* Create and manage projects
* Create tasks under projects
* Edit tasks
* Delete tasks
* Mark tasks as completed
* Flash success messages
* Nested project → task routes
* Basic feature tests

## Validation Rules

When creating **projects** or **tasks**, the following validation rules apply:

* Minimum **10 characters**
* Only **letters and numbers allowed**
* **No special characters**

Example validation rule used in the application:

```php
'name' => ['required', 'min:10', 'regex:/^[A-Za-z0-9 ]+$/']
```

## Test User Logins

User A
Email: [usera@example.com](mailto:usera@example.com)
Password: password

User B
Email: [userb@example.com](mailto:userb@example.com)
Password: password

## Installation

Install dependencies:

```bash
composer install
npm install
```

Copy environment file and generate key:

```bash
cp .env.example .env
php artisan key:generate
```

## Database Setup

Create database in MySQL:

```sql
CREATE DATABASE task_manager;
```

Create database user:

```sql
CREATE USER 'task_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON task_manager.* TO 'task_user'@'localhost';
FLUSH PRIVILEGES;
```

Update `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_tasks
DB_USERNAME=task_user
DB_PASSWORD=password
```

Run migrations and seeders:

```bash
php artisan migrate --seed
```

## Run the Application

Run in **two terminals**.

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Open:

```
http://127.0.0.1:8000
```

## Run Tests

```bash
php artisan test
```

## Tech Stack

* Laravel
* PHP
* Blade
* Tailwind CSS
* MySQL
* PHPUnit