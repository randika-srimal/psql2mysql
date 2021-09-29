<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Medoo\Medoo;

$postgreConnection = new Medoo([
	'type' => 'postgresql',
	'host' => $_ENV['POSTGRESQL_HOST'],
	'database' => $_ENV['POSTGRESQL_DATABASE'],
	'username' => $_ENV['POSTGRESQL_USER'],
	'password' => $_ENV['POSTGRESQL_PASSWORD'],
	'port' => $_ENV['POSTGRESQL_PORT'],
]);

$mySqlConnection = new Medoo([
	'type' => 'mysql',
	'host' => $_ENV['MYSQL_HOST'],
	'database' => $_ENV['MYSQL_DATABASE'],
	'username' => $_ENV['MYSQL_USER'],
	'password' => $_ENV['MYSQL_PASSWORD'],
	'port' => $_ENV['MYSQL_PORT'],
]);

$data = $postgreConnection->select('users', '*');
 
echo json_encode($data);
