<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Laravel-REST-API

### Laravel REST API with Authentication using Laravel Sanctum
 
##  How to Use:

### Run in the command:
- composer install
- composer require laravel/sanctum
- php artisan key:generate
- copy .env.example .env


### Create a database named 'customercarsapi'

### Run in the command:
- php artisan migrate -seed

#### After that, you may now start laravel by running in the comment
- php artisan serve


### These are the following APIs with unit tests

#### /api/login - Login API that can access to all APIs. 
#### /api/register - Register API that can generate an authentication token. 
#### /api/customers/ - POST api to create a customer record
#### /api/customers/ - UPDATE api to update a customer record
#### /api/customers/ - DELETE api to delete a customer record
#### /api/customers/ - GET api to get the list of customers
#### /api/cars/ - POST api to create one or more car records for a specific customer
#### /api/cars/{car_id} - UPDATE api to update a car record
#### /cars/{car_id} - DELETE api to delete a car record
#### /api/customers/{customer_id}/cars - GET api to get the list of cars owned by a specific customer

### Rules
#### A customer can have many cars
#### A customer can only be deleted if he/she does not own any car
#### The generated token should be included in all other API calls.
#### When calling the APIs, an incorrect token should result in error.
