<?php include_once('utilities.php'); ?> <!-- Se incluye para acceder al array de usuarios y a las funciones -->
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
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>

              <!-- Se verifica que el arreglo de usuarios no esté vacío -->
              <?php if(!empty($usuarios)){ ?>
                <!-- Se verifica que haya alumnos registrados en el archivo -->
                <?php if($totalAlumnos): ?>
                  <h3>Lista de alumnos</h3>
                  <table>
                    <thead>
                      <tr>
                        <!-- Datos de los alumnos -->
                        <th width="200">Matrícula</th>
                        <th width="250">Nombre</th>
                        <th width="250">Carrera</th>
                        <th width="250">Correo</th>
                        <th width="250">Teléfono</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Ciclo para imprimir todos los alumnos y su respectiva información -->
                      <?php foreach($usuarios as $usuario): ?>
                        <?php if($usuario[0] == 0):?>
                          <tr>
                            <td><?php echo $usuario[1] ?></td>
                            <td><?php echo $usuario[2] ?></td>
                            <td><?php echo $usuario[3] ?></td>
                            <td><?php echo $usuario[4] ?></td>
                            <td><?php echo $usuario[5] ?></td>
                            <td><a href="./key.php?id=<?php echo $usuario[1]; ?>" class="button radius tiny secondary">Ver detalles</a></td>
                          </tr>
                        <?php endif ?>
                      <?php endforeach ?>
                      <tr>
                        <td colspan="4"><b>Total de registros: </b> <?php echo $totalAlumnos; ?></td> <!-- Se imprime el total de alumnos -->
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <br>
                <?php endif ?>

                <!-- Se verifica que haya profesores registrados en el archivo -->
                <?php if($totalProfesores): ?>
                  <h3>Lista de profesores</h3>
                  <table>
                    <thead>
                      <tr>
                        <!-- Información del profesor -->
                        <th width="200">No. de empleado</th>
                        <th width="250">Nombre</th>
                        <th width="250">Carrera</th>
                        <th width="250">Teléfono</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Ciclo para mostrar todos los profesores con su respectiva información -->
                      <?php foreach($usuarios as $usuario): ?>
                        <?php if($usuario[0] == 1):?>
                          <tr>
                            <td><?php echo $usuario[1] ?></td>
                            <td><?php echo $usuario[2] ?></td>
                            <td><?php echo $usuario[3] ?></td>
                            <td><?php echo $usuario[4] ?></td>
                            <td><a href="./key.php?id=<?php echo $usuario[1]; ?>" class="button radius tiny secondary">Ver detalles</a></td>
                          </tr>
                        <?php endif ?>
                      <?php endforeach ?>
                      <tr>
                        <td colspan="4"><b>Total de registros: </b> <?php echo $totalProfesores; ?></td> <!-- Se imprime el total de profesores -->
                      </tr>
                    </tbody>
                  </table>
                <?php endif ?>

              <?php }else{ ?>
              No hay registros <!-- En caso de que no haya ningún registro en el archivo se mostrará este mensaje -->
              <?php } ?>
            </div>
          </section>
        </div>
      </div>

    </div>


    <?php require_once('footer.php'); ?>
