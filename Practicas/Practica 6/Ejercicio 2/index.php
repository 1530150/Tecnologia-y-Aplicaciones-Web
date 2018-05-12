<?php
  require_once("database_details.php");

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Equipos de la Universidad Politécnica de Victoria</title>
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
            <div class="content" data-slug="panel1">
              <div class="row">
                <h3>Totales</h3>
                <table>
                  <thead>
                    <tr>
                      <!-- Datos totales -->
                      <th width="200">Futbolistas</th>
                      <th width="200">basquetbolistas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Se imprimen el número de futbolistas y basquetbolistas -->
                      <?php conectar(); ?>
                      <tr>
                        <td><?php echo getNumJugadores("Fútbol"); ?></td>
                        <td><?php echo getNumJugadores("Basquetbol"); ?></td>
                      </tr>
                      <?php desconectar(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>

    </div>

    <?php require_once('footer.php'); ?>
