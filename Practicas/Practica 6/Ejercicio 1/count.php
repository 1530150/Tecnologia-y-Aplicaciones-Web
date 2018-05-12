<?php
require_once('connection.php');

//Funcion para obtener los datos de una tabla
function obtenerDatos($tabla){
  global $pdo;

  $sql = "SELECT * FROM $tabla";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  return $statement->fetchAll();
}

//Función para obtener cuantos usuarios están activos o inactivos
function activosInactivos($status){
  global $pdo;

  $sql = "SELECT COUNT(*) FROM user WHERE status_id=$status";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  return $statement->fetchColumn();
}

//Función para obtener el nombre del status
function getStatus($id){
  global $pdo;

  $sql = "SELECT name FROM status WHERE id=$id";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  return $statement->fetchColumn();
}

//Función para obtener el nombre del tipo
function getUserType($id){
  global $pdo;

  $sql = "SELECT name FROM user_type WHERE id=$id";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  return $statement->fetchColumn();
}

//Función para obtener el correo del usuario
function getUser($id){
  global $pdo;

  $sql = "SELECT email FROM user WHERE id=$id";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  return $statement->fetchColumn();
}

$status = obtenerDatos("status"); //Obtener datos de la tabla status
$user = obtenerDatos("user"); //Obtener datos de la tabla user
$user_log = obtenerDatos("user_log"); //Obtener datos de la tabla user_log
$user_type = obtenerDatos("user_type"); //Obtener datos de la tabla user_type

$totalStatus = sizeof($status); //Total de registros en la tabla status
$totalUser = sizeof($user); //Total de registros en la tabla user
$totalUser_log = sizeof($user_log); //Total de registros en la tabla user_log
$totalUser_type = sizeof($user_type); //Total de registros en la tabla user_type

$activos = activosInactivos(1); //Total de usuarios activos
$inactivos = activosInactivos(2); //Total de usuarios inactivos
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>PHP & SQL</title>
<link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
</head>
<body>

<div class="top-bar">
<div class="top-bar-left">
<ul class="menu">
<li class="menu-text">Curso PHP & SQL</li>
</ul>
</div>
</div>
<div class="row column text-center">
<h2>Contando datos</h2>
<hr>
</div>
<!-- Tabla con datos generales -->
<div class="row column">
<div class="callout success">
<h3>Totales</h3>
</div>
<table width="100%">
  <thead>
    <tr>
      <th>Usuarios</th>
      <th>Tipos</th>
      <th>Status</th>
      <th>Accesos</th>
      <th>Usuarios Activos</th>
      <th>Usuarios Inactivos</th>
    </tr>
  </thead>
  <tbody>
    <!-- Se imprimen los datos dentro de la tabla -->
    <tr>
      <td><?php echo $totalStatus ?></td>
      <td><?php echo $totalUser ?></td>
      <td><?php echo $totalUser_log ?></td>
      <td><?php echo $totalUser_type ?></td>
      <td><?php echo $activos ?></td>
      <td><?php echo $inactivos ?></td>
    </tr>
  </tbody>
</table>
</div>


<hr>
<br>
<br>
<br>
<br>

<!-- Tablas -->
<div class="row column text-center">
<h2>Tablas</h2>
<hr>
</div>

<!-- Tabla Status -->
<div class="row column">
<div class="callout success">
<h3>Status</h3>
</div>
<table width="100%">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <!-- Ciclo para generar filas con los datos de la tabla -->
    <?php foreach($status as $valor): ?>
      <tr>
        <td><?php echo $valor[0] ?></td>
        <td><?php echo $valor[1] ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
</div>


<hr>

<!-- Tabla User -->
<div class="row column">
<div class="callout success">
<h3>User</h3>
</div>
<table width="100%">
  <thead>
    <tr>
      <th>Id</th>
      <th>email</th>
      <th>Password</th>
      <th>Status</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
    <!-- Ciclo para generar filas con los datos de la tabla -->
    <?php foreach($user as $valor): ?>
      <tr>
        <td><?php echo $valor[0] ?></td>
        <td><?php echo $valor[1] ?></td>
        <td><?php echo $valor[2] ?></td>
        <td><?php echo getStatus($valor[3]) ?></td>
        <td><?php echo getUserType($valor[4]) ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
</div>


<hr>

<!-- Tabla User Log -->
<div class="row column">
<div class="callout success">
<h3>User Log</h3>
</div>
<table width="100%">
  <thead>
    <tr>
      <th>Id</th>
      <th>Date Logged</th>
      <th>User</th>
    </tr>
  </thead>
  <tbody>
    <!-- Ciclo para generar filas con los datos de la tabla -->
    <?php foreach($user_log as $valor): ?>
      <tr>
        <td><?php echo $valor[0] ?></td>
        <td><?php echo $valor[1] ?></td>
        <td><?php echo getUser($valor[2]) ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
</div>


<hr>

<!-- Tabla User Type -->
<div class="row column">
<div class="callout success">
<h3>User Type</h3>
</div>
<table width="100%">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <!-- Ciclo para generar filas con los datos de la tabla -->
    <?php foreach($user_type as $valor): ?>
      <tr>
        <td><?php echo $valor[0] ?></td>
        <td><?php echo $valor[1] ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
</div>


<hr>



</div>
<div class="large-3 large-offset-2 columns">
</div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>
      $(document).foundation();
    </script>
</body>
</html>
