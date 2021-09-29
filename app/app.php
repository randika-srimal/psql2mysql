<?php
require_once __DIR__ . '/vendor/autoload.php';

use Medoo\Medoo;

$mySqlDatabase = new Medoo([
	'type' => 'mysql',
	'host' => '127.0.0.1',
	'database' => 'levantine_hill',
	'username' => 'root',
	'password' => 'root',
	'port' => 3306,
]);

$data = $mySqlDatabase->select('users', '*');
 
echo json_encode($data);
