# REST API example - uTask

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.7/installation#installation)

```console
#Clone the repository
git clone https://github.com/pepsikus/example-api-utask.git
#Switch to the repo folder
cd example-api-utask
#Install all the dependencies using composer
composer install
#Copy the example env file and make the required configuration changes in the .env file
cp .env.example .env
#Generate a new application key
php artisan key:generate
#Run the database migrations (**Set the database connection in .env before migrating**)
php artisan migrate
#Start the local development server
php artisan serve
```
You can now access the server at http://localhost:8000
  
**Make sure you set the correct database connection information before running the migrations**


## API Specification

Required request headers

| **Required**  | **Key**               | **Value**             |
|---------- |------------------ |------------------ |
| Yes       | Content-Type      | application/json  |
| Yes       | Accept            | application/json  |

Available endpoints

| Method    | URI                           | Description       |   Returns (http code, data) |
|-----------|-------------------------------|-------------------|-----------------------------|
| GET       | api/users                     | Get user list     | 201, User list JSON         |
| POST      | api/users                     | Create user       | 201, User JSON              |
| GET       | api/users/{user}              | Get user          | 201, User JSON              |
| PUT       | api/users/{user}              | Update user       | 200, User JSON              |
| DELETE    | api/users/{user}              | Delete user       | 204, empty                  |
| GET       | api/users/{user}/tasks        | Get user tasks    | 200, User JSON              |
| PUT       | api/users/{user}/verify_email | Verify user email | 200, User JSON              |
| GET       | api/tasks                     | Get task list     | 200, Task list JSON         |
| POST      | api/tasks                     | Create task       | 201, Task JSON              |
| GET       | api/tasks/{task}              | Get task          | 200, Task JSON              |
| PUT       | api/tasks/{task}              | Update task       | 200, Task JSON              |
| DELETE    | api/tasks/{task}              | Delete task       | 204, empty                  |
| PUT       | api/tasks/{task}/complete     | Complete task     | 200, Task JSON              |

> [Full API Spec](https://github.com/pepsikus/example-api-utask/docs/api-specs.md)


## Testing API

All tests runs on sqlite in-memory database.

Copy test enviroments
```console
cp .env.example.testing .env
```

Run tests
```console
composer test
```
or
```
vendor/bin/phpunit
```
