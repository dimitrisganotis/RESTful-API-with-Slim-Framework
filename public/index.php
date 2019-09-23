<?php

require '../vendor/autoload.php';

// Instantiate the app
$settings = require '../src/settings.php';
$app = new \Slim\App($settings);

// Dependencies
require '../src/dependencies.php';

// Routes
require '../src/routes.php';

$app->run();