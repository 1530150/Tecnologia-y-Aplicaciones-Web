<!doctype html>
<?php
  include_once RUTA_APP . "/models/HomeModel.php"; //Modelo para sesiones

  //Se valida si hay una sesión iniciada
  if(!HomeModel::sesionIniciada()){
    header("Location: " . RUTA_URL . "/public/home/login"); //Si no la hay manda al login
  }
?>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo NOMBRE_SITIO?></title>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/css/foundation.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
<div class="row">
      <div class="large-3 columns">
        <h1><img src="<?php echo RUTA_URL?>/public/img/logo.png"/></h1>
      </div>
      <!-- Nenú superior -->
      <div class="large-12 columns">
        <ul class="right button-group" style="margin-top: -60px">
          <li style="padding: 13px; background-color: #008CBA; color: #fff"; marg>Bienvenido, <?php echo $_SESSION["usuario"] ?></li>
          <li><a href="<?php echo RUTA_URL?>/public/home/cerrarSesion" class="button">Cerrar sesión</a></li>
        </ul>
        <ul class="left button-group">
          <li><a href="<?php echo RUTA_URL?>/public/home/" class="button">Inicio</a></li>
          <!-- Se comprueba que el usuario sea un admin para ver qué mostrarle en el menú -->
          <?php if(HomeModel::esAdmin()): ?>
            <li><a href="<?php echo RUTA_URL?>/public/alumnos/" class="button">Alumnos</a></li>
            <li><a href="<?php echo RUTA_URL?>/public/profesores/" class="button">Profesores</a></li>
            <li><a href="<?php echo RUTA_URL?>/public/carreras/" class="button">Carreras</a></li>
            <li><a href="<?php echo RUTA_URL?>/public/tutorias/index/<?php echo $_SESSION["id"] ?>" class="button">Tutorías</a></li>
          <?php else: ?>
            <li><a href="<?php echo RUTA_URL?>/public/tutorias/agregarTutoria/<?php echo $_SESSION["id"] ?>" class="button">Agregar tutoría</a></li>
          <?php endif ?>
          <li><a href="<?php echo RUTA_URL?>/public/reportes/<?php echo $_SESSION["id"] ?>" class="button">Reportes</a></li>
        </ul>
      </div>
    </div>
