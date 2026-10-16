job_listing_service

1.Project Goal
Building an application to manage job listings using Laravel and PHP, with main focus on the backend and REST API.

2.Core Models
-Job: representing job listings
-Company: representing companies that offer jobs
-User: representing users who belong to companies

3.Relationships
-A company has many jobs (1).
-A company has many users (n).
-A user can belong to many companies (m).
    ->table company_user (m:n).
-A job belongs to one company (n:1).

4.APIs
RESTful CRUD endpoints for jobs and companies:
-CREATE: POST
-LIST: GET collection
-SHOW: GET single resource
-UPDATE: PUT
-DELETE: DELETE

An authenticated-user endpoint returns the currently authenticated user.

5.Security/Validation
-Everyone can view job listings.
-Only authenticated user can create new job listings.
-Only the creator of a job listing can edit it (update, delete).
-Incoming Data is validated.
-Using Laravel Policies to enforce authorization.

6.Development Approach
-Laravel migrations to define database schemas.
-Focused controllers separate responsibilities.
-Seeders provide reproducible sample data.
-Automated tests verify application behavior.
-Git tracks incremantal changes.

7.Installation and Setup
Requirements
-PHP
-Composer
-Node.js and npm
-SQLite

Setup
7.1.Install PHP dependencies:

        composer install

7.2.Install JavaScript dependencies:

        npm install

7.3.Create the environment file if it does not exist:

        copy .env.example .env

7.4.Generate the application key:

        php artisan key:generate

7.5.Create the SQLite database file if it does not exist:

        database/database.sqlite

7.6.Configure .env to use SQLite.

7.7.Run migrations and seed the database:

    php artisan migrate --seed

---------------------------------------------------------
Run the application:

    php artisan serve

Run tests:

    php artisan test

--------------------------------------------------------

8.Optional Extensions
-Consider categories.
-Image uploads.
-Caching.
-Frontend.