<p align="center"><a href="https://github.com/dwiksurya/task-project-crud-datatables-serverside">Laravel CRUD Datatables Serverside</a></p>

* [Installation](#Installation)
* [Credentials](#Credentials)
* [Access](#access)

## Installation
In the root folder, find the .env file and change the following values

```sh
APP_NAME=
APP_URL=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Through terminal or command prompt, update composer to install the dependencies:

```sh
composer update
```
Run the migration command to create the tables

```sh
php artisan migrate
```

Run the seeder to import mandatory values to the tables

```sh
php artisan db:seed
```  

## Credentials

|     Email ID    |   Password    |
|    ----------   | ------------- |
|  user@email.com |    654321     |


## Access

Akses at the following link using user credentials:

```sh
http://127.0.0.1:8000
```
Login at the following link using user credentials:

```sh
http://127.0.0.1:8000/login
```
