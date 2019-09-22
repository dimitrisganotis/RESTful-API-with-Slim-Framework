<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get All Books
$app->get('/api/books', function (Request $request, Response $response) {
  $query = "SELECT * FROM books ORDER BY id";

  try {
    $result = $this->db->query($query);

    $data = $result->fetchAll();

    return $response->withStatus(200)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson($data);
  } catch(PDOException $e) {
    $error[] = $e->getMessage();

    return $response->withStatus(200)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson($error);
  }
});

// Get Single Book
$app->get('/api/books/{id}', function (Request $request, Response $response, array $args) {
  $id = $args['id'];

  $query = "SELECT * FROM books WHERE id = ?";

  $parameters = [
    $id
  ];

  try {
    $result = $this->db->prepare($query);
    $result->execute($parameters);

    $data = $result->fetchAll();

    if(empty($data))
      $data = ["message" => "There is not any book with this id!"];

    return $response->withStatus(200)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson($data);
  } catch(PDOException $e) {
    $error[] = $e->getMessage();

    return $response->withStatus(200)
                    ->withHeader('Content-Type', 'application/json')
                    ->withJson($error);
  }
});