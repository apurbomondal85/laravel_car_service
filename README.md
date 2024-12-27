
# Dynamic-Website


## Requirements

- PHP ^8.0.2
- Laravel ^9.19
- Node js ^18.16.0
- Yajra Datatables ^9.0
- Sweet Alert ^5.1


## Installation


1. Clone the repository

    git clone git clone https://kaamrul06@bitbucket.org/web-solution-firm/rainbow-roofing.git

2. Switch to the repo folder

    cd dynamic-website

3. Install all the dependencies using composer & npm

    composer install
    npm install

4. Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

5. Generate a new application key

    php artisan key:generate

6. Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

7. Start the local development server

    php artisan serve
    npm run dev

You can now access the server at http://localhost:8000

**TLDR command list**

    git clone git clone https://kaamrul06@bitbucket.org/web-solution-firm/rainbow-roofing.git
    cd dynamic-website
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve
    npm run dev

## Database seeding

**Populate the database with seed data with relationships which includes users, roles, permissions, configs, email templates, notifications and role of honor. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DatabaseSeeder and set the property values as per your requirement

    database/seeders/DatabaseSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

    or
    
    php artisan migrate:fresh --seed --seeder=DatabaseSeeder
    
## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing Dynamic-Website App

Run the laravel development server

    php artisan serve
    npm run dev

The frontend can now be accessed at

    http://localhost:8000/

And the backend can now be accessed at

    http://admin.localhost:8000/

Admin Login Access

    admin email: admin@example.com
    password: 123456
