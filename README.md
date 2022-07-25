## Install for local dev

Clone the git repository

Create new database (MySQL or PostgreSQL)

Rename `env.example` file to `.env` and update the database connection details in `.env` file

Generate and add the key to the `.env` file. Key can be obtain by running `php artisan key:generate --show`

Run `composer install`

Run `php artisan migrate` to create database tables

Run `php artisan db:seed` (this will create admin account for logging in)

Create storage link by running `php artisan storage:link`

Run `npm install && npm run dev` (This may have to be run in a separate terminal window)

Run `php artisan serve`

Browse to app url, by default http://localhost:8000