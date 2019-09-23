<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get All Books
$app->get('/api/books', function (Request $request, Response $response) {
  $query = "SELECT * FROM books ORDER BY id";

  try {
    $result = $this->db->query($query);

    $data = $result->fetchAll();

    return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->withJson($data);
  } catch(PDOException $e) {
    $error = [
      "status" => "400",
      "message" => "There was an error retrieving all the books.",
      "more_info" => $e->getMessage()
    ];

    return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->withJson($error);
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

    $data = $result->fetch();

    if(!empty($data)) {
      return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->withJson($data);
    } else {
      $data = [
        "status" => "404",
        "message" => "There is not any book with this id."
      ];

      return $response->withStatus(404)->withHeader('Content-Type', 'application/json')->withJson($data); 
    }
  } catch(PDOException $e) {
    $error = [
      "status" => "400",
      "message" => "There was an error retrieving this book.",
      "more_info" => $e->getMessage()
    ];

    return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->withJson($error);
  }
});

// Add New Book
$app->post('/api/books', function (Request $request, Response $response) {
  $query = "INSERT INTO books (name, isbn, category) VALUES (?, ?, ?)";

  $parameters = [
    $request->getParam('name'),
    $request->getParam('isbn'),
    $request->getParam('category')
  ];

  try {
    $result = $this->db->prepare($query);
    $result->execute($parameters);

    $data = [
      "status" => "201",
      "message" => "The book has been created."
    ];

    return $response->withStatus(201)->withHeader('Content-Type', 'application/json')->withJson($data);
  } catch(PDOException $e) {
    $error = [
      "status" => "400",
      "message" => "There was an error adding the book.",
      "more_info" => $e->getMessage()
    ];

    return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->withJson($error);
  }
});

// Update Book
$app->put('/api/books/{id}', function (Request $request, Response $response, array $args) {
  $id = $args['id'];
  $name = $request->getParam('name');
  $isbn = $request->getParam('isbn');
  $category = $request->getParam('category');

  $query = "UPDATE books SET ";

  if(!empty($name) && empty($isbn) && empty($category))
    $query .= "name = ?";
  else if(!empty($name))
    $query .= "name = ?,";

  if(!empty($isbn) && empty($category))
    $query .= "isbn = ?";
  else if(!empty($isbn))
    $query .= "isbn = ?,";

  if(!empty($category))
    $query .= "category = ?";

  $query .= " WHERE id = ?";

  if(!empty($name))
    $parameters[] = $name;
  if(!empty($isbn))
    $parameters[] = $isbn;
  if(!empty($category))
    $parameters[] = $category;

  $parameters[] = $id;

  try {
    $result = $this->db->prepare($query);
    $result->execute($parameters);

    if($result->rowCount() > 0) {
      $data = [
        "status" => "200",
        "message" => "The book has been updated."
      ];

      return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->withJson($data);
    } else {
      $data = [
        "status" => "404",
        "message" => "There is not any book with this id to update."
      ];

      return $response->withStatus(404)->withHeader('Content-Type', 'application/json')->withJson($data);
    }
  } catch(PDOException $e) {
    $error = [
      "status" => "400",
      "message" => "There was an error updating the book.",
      "more_info" => $e->getMessage()
    ];

    return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->withJson($error);
  }
});

// Delete Book
$app->delete('/api/books/{id}', function (Request $request, Response $response, array $args) {
  $id = $args['id'];

  $query = "DELETE FROM books WHERE id = ?";

  $parameters = [
    $id
  ];

  try {
    $result = $this->db->prepare($query);
    $result->execute($parameters);
    
    if($result->rowCount() > 0) {
      $data = [
        "status" => "200",
        "message" => "The book has been deleted."
      ];

      return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->withJson($data);
    } else {
      $data = [
        "status" => "404",
        "message" => "There is not any book with this id to delete."
      ];

      return $response->withStatus(404)->withHeader('Content-Type', 'application/json')->withJson($data);
    }
  } catch(PDOException $e) {
    $error = [
      "status" => "400",
      "message" => "There was an error deleting the book.",
      "more_info" => $e->getMessage()
    ];

    return $response->withStatus(400)->withHeader('Content-Type', 'application/json')->withJson($error);
  }
});