# RESTful API with Slim Framework (version 3.12)

This is a simple RESTful API built with the SlimPHP framework and uses MySQL for storage.

## Version
1.0

## Installation

Create database or import from _schema.sql

Edit db/config params

Install SlimPHP and dependencies

```sh
$ composer require slim/slim "^3.12"
```

## API Endpints
```sh
$ GET /api/books
$ GET /api/books/{id}
```