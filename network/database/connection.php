<?php
$databaseHost = '127.0.0.1:3306';
$databaseName = 'MD17306';
$databaseUsername = 'root';
$databasePassword = '24092003';

// $databaseHost = 'db4free.net:3306';
// $databaseName = 'MD17306';
// $databaseUsername = 'picassimp';
// $databasePassword = '@@menoknow2409';

try {
	$dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", 
						$databaseUsername, $databasePassword);
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}