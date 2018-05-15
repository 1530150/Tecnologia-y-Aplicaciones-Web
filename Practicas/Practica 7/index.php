<?php
  require_once("database_details.php");

  //Se comprueba si se ha iniciado sesión
  if(!sesionIniciada()){
    //Se comprueba si hay una cookie guardada
    if(isset($_COOKIE["usuario"])){
      //Si es así entonces se inicia sesión con los datos guardados en la cookie
      session_start();
      $_SESSION["usuario"] = $_COOKIE["usuario"];
      setcookie("usuario", $_SESSION["usuario"], time()+(60*60*24*365));
      header("Location: ./"); //Se actualiza la página
    }
    else{
      header('Location: login.php'); //Si no se llevará al login
    }
  }

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Venta de ropa</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>

    <?php require_once('header.php'); ?>


    <div class="row">

      <div class="large-9 columns">
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="large-12 columns">
              <ul style="text-align: center; list-style-type: none;">
                <!-- Boton para ir al formulario -->
                <li><a href="formProductos.php" class="button">Nueva producto</a></li>
                <li><a href="formVenta.php" class="button">Formulario de venta</a></li>
                <li><a href="reporte.php" class="button">Ver reporte de venta</a></li>
              </ul>
            </div>
          </section>
        </div>
      </div>

    </div>

    <?php require_once('footer.php'); ?>
