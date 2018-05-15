<?php require_once("database_details.php"); ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Venta de ropa</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
<div class="row">
      <div class="large-3 columns">
        <h1><img src="./img/logo.png"/></h1>
      </div>
      <!-- Nenú superior -->
      <div class="large-12 columns">
        <ul class="left button-group">
          <li><a href="index.php" class="button">Inicio</a></li>
        </ul>
        <ul class="right button-group">
          <li style="padding: 13px; background-color: #008CBA; color: #fff"; marg>Bienvenido <?php echo $_SESSION["usuario"] ?></li>
          <li><a href="cerrar_sesion.php" class="button">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
