# Blog Commenting System

This is a simple blog commenting system built with Laravel. The system allows users to create blog posts, comment on them, and manage their own comments. The owner of a post can view and delete comments. Additionally, the system includes functionality for filtering posts by category and a login/logout feature.

## Features
- **Post Management**: Users can create, edit, and delete blog posts.
- **Comment System**: Users can add comments to posts, view all comments, and edit/delete their own comments.
- **Post Filtering**: Users can filter posts by category.
- **Login/Logout**: User authentication to manage post and comment permissions using Laravel’s built-in authentication system with Bootstrap-based UI for login and registration.
- **Policies**: Post and comment actions are governed by Laravel Policies to ensure proper authorization.

## Technologies Used
- **Backend**: Laravel 11
- **Database**: MySQL
- **ORM**: Eloquent ORM for database interactions
- **Frontend**: Blade templating engine, Bootstrap for UI
- **Authentication**: Laravel’s built-in authentication system with Bootstrap-based UI

## Setup Instructions
1. Clone the repository:
    ```bash
    git clone https://github.com/kalam614/blog-comment.git
    ```
2. Install dependencies:
    ```bash
    composer install
    ```
3. Set up your `.env` file:
    ```bash
    cp .env.example .env
    ```
    Update the database connection settings in `.env`.

4. Run migrations to set up the database:
    ```bash
    php artisan migrate
    ```

5. (Optional) Seed the database with demo data:
    ```bash
    php artisan db:seed
    ```

6. Install authentication scaffolding (UI):
    ```bash
    composer require laravel/ui
    php artisan ui bootstrap --auth
    npm install && npm run dev
    ```

7. Serve the application:
    ```bash
    php artisan serve
    ```

Visit `http://localhost:8000` to access the application.

## Seeder Information
To make it easier for testers to evaluate the application, a seeder file is included which generates demo posts, categories, and comments. You can run the seeder using the following command after migrating the database:
```bash
php artisan db:seed
