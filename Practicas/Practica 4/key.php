<?php
include_once('utilities.php'); //Se incluye para acceder al array de usuarios y a las funciones

$id = isset( $_GET['id'] ) ? $_GET['id'] : ''; //Se obtiene el id

$usuario; //Se define una variable usuario

//Si el usuario no existe entonces inmediatamente se terminará el proceso, si existe se guardará su información
if(!$usuario = buscarUsuario($id)){
  die('No existe dicho usuario');
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>

    <?php require_once('header.php'); ?>

    <div class="row">

      <div class="large-9 columns">
        <h3>Detalles del usuario</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <ul class="pricing-table">
                <li class="title">Detalles del usuario</li>

                <!-- Ciclo para listar la información del usuario  -->
                <?php for($i=1; $i < sizeof($usuario); $i++): ?>
                  <li class="description"><?php echo $usuario[$i] ?></li>
                <?php endfor ?>
              </ul>
            </div>
          </section>
        </div>
      </div>
    </div>

    <?php require_once('footer.php'); ?>
