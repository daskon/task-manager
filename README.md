# Project & Task Management App

A simple Laravel application to manage **Projects and Tasks**.
Built using **Laravel, Breeze authentication, Blade, and Tailwind CSS**.

## Features Completed

* User authentication (Laravel Breeze)
* Create projects
* View project list
* Create tasks under projects
* Edit tasks
* Delete tasks
* Mark tasks as completed
* Nested task routes under projects
* Flash success messages
* Basic feature tests

## Test User Logins

Use the following accounts to test the application:

User A
Email: [usera@example.com](mailto:usera@example.com)
Password: password

User B
Email: [userb@example.com](mailto:userb@example.com)
Password: password

## Installation

Clone the repository and install dependencies.

```bash
composer install
npm install
```

Copy environment file and generate key.

```bash
cp .env.example .env
php artisan key:generate
```

Run migrations and seeders.

```bash
php artisan migrate --seed
```

## Run the Application

Two terminals are required.

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Application will be available at:

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
* MySQL / SQLite
* PHPUnit