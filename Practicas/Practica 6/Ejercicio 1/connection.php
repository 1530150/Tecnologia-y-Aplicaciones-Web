<?php
//Datos de la base de datos
$dsn = 'mysql:dbname=php_sql_course;host=localhost';
$user = 'root';
$password = '';

//Se realiza la conexión dentro de un try para atrapar los errores en dado caso de que se generen
try{

	$pdo = new PDO(	$dsn,
					$user,
					$password
					);

}catch( PDOException $e ){
	echo 'Error al conectarnos: ' . $e->getMessage();
}
