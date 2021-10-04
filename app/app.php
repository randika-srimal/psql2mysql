<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Medoo\Medoo;

try {
	$postgreConnection = new Medoo([
		'type' => 'pgsql',
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


	foreach ($argv as $argument) {
		if ($argument != reset($argv)) {
			$tableName = $argument;

			$postgresData = $postgreConnection->select($tableName, '*');
			$recordsCountToImport = count($postgresData);

			if ($recordsCountToImport > 0) {
				echo "Started to import {$recordsCountToImport} records from {$tableName} table.\n";

				$columnNames = array_keys($postgresData[0]);

				foreach ($postgresData as $postgresRecord) {

					$insertRecord = [];

					foreach ($columnNames as $columnName) {
						$insertRecord[$columnName] = $postgresRecord[$columnName];
					}

					$mySqlConnection->insert($tableName, $insertRecord);
				}

				echo "Successfully imported {$recordsCountToImport} records from {$tableName} table.\n";
			} else {
				echo "No records to import from {$tableName} table.\n";
			}
		}
	}
} catch (\Throwable $th) {
	var_dump($th);
}
