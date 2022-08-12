# Laravel-REST-API

 Laravel REST API with Authentication
 
 How to Use:
    Run in the command:
        composer install
        composer require laravel/sanctum
        php artisan key:generate
        copy .env.example .env

    Create a database named 'customercarsapi'

    Run in the command:
        php artisan migrate -seed

    Used commands:
        php artisan make:resource CustomersResource
