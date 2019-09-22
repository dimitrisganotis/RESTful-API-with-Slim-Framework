<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
//require '../src/config/db.php';

$config = [
  'displayErrorDetails' => TRUE,
  'addContentLengthHeader' => FALSE,
  "db" => [
    'host' => 'localhost',
    'dbname' => 'library',
    'user' => 'root',
    'pass' => ''
  ]
];

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();
$container['db'] = function ($c) {
  $db = $c['settings']['db'];
  $pdo = new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'], $db['user'], $db['pass']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $pdo;
};

// Books Route
require '../src/routes/books.php';

$app->run();