<h1>Application to register products with JWT Authentication and VueJS</h1>

<h3>The idea</h3>
The idea to make this project came from the backend challenges Github repository, to be more specific,
from the [Orbital test](https://gitlab.com/orbital-code/orbital/tests/backend-developer/-/tree/master). The challenge
consist in create a application to register products with JWT authentication, and consume this API with VueJS.

<h3>How to setup the project</h3>
To setup the project, follow the steps below
```bash
# clone the repository
$ git clone git@github.com:thalesmengue/orbital-test.git

# enter the project folder

# create the .env file
$ cp .env.example .env

# install the npm dependencies
$ npm install

# install the dependencies
$ composer install

# generate the application key
$ php artisan key:generate

# generate the jwt package secret key
$ php artisan jwt:secret

# migrate the database
$ php artisan migrate

# then you can run the project
$ php artisan serve

&&

$ npm run dev
```

<h3>References</h3>
[PHP 8.1](https://www.php.net/docs.php)
<br>
[Laravel 10.0](https://laravel.com/docs/10.x/installation)
<br>
[VueJS](https://vuejs.org/v2/guide/)
<br>
[JWT](https://laravel-jwt-auth.readthedocs.io/en/latest/)
