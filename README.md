# RESTful API with the Slim Framework

This is a simple Public RESTful API built with the Slim Framework (^3.12) and MySQL.

## Installation

Create database or import from _schema.sql

Edit src/settings params

Install SlimPHP and dependencies

```sh
$ composer install
```

## Endpoints

- Get All Books: `GET /api/books`
- Get One Book: `GET /api/books/{id}`
- Create Book: `POST /api/books`
- Update Book: `PUT /api/books/{id}`
- Delete Book: `DELETE /api/books/{id}`


## Local Server

Start the API by running:

```sh
$ php -S localhost:8080
```

inside the public folder.
