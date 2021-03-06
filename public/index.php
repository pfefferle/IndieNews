<?php
chdir('..');
require 'vendor/autoload.php';
require 'lib/Savant.php';
require 'lib/helpers.php';
require 'lib/mf2.php';
require 'lib/timeago.php';
require 'lib/config.php';

// Configure the Savant plugin
\Slim\Extras\Views\Savant::$savantDirectory = 'lib/Savant3';
\Slim\Extras\Views\Savant::$savantOptions = array('template_path' => 'views');

// Set up the database connection
ORM::configure('mysql:host=' . Config::$dbHost . ';dbname=' . Config::$dbName);
ORM::configure('username', Config::$dbUsername);
ORM::configure('password', Config::$dbPassword);

// Create a new app object with the Savant view renderer
$app = new \Slim\Slim(array(
  'view' => new \Slim\Extras\Views\Savant()
));

require 'controllers/controllers.php';
require 'controllers/webmention.php';
require 'controllers/parser.php';

session_start();

$app->run();

