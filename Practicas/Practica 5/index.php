<?php
  require_once("database_details.php");

  $usuarios = getUsuarios(); //Se obtienen todos los usuarios y se guardan en el array
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
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
              </div>

              <!-- Se verifica que el arreglo de usuarios no esté vacío -->
              <?php if(!empty($usuarios)): ?>
                  <h3>Lista de usuarios</h3>
                  <table>
                    <thead>
                      <tr>
                        <!-- Datos de los alumnos -->
                        <th width="200">ID</th>
                        <th width="500">Nombre</th>
                        <th width="250">Edad</th>
                        <th width="250">Correo</th>
                        <th width="250">Teléfono</th>
                        <th width="500">Dirección</th>
                        <th width="500">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Ciclo para imprimir todos los alumnos y su respectiva información -->
                      <?php foreach($usuarios as $usuario): ?>
                          <tr>
                            <td><?php echo $usuario[0] ?></td>
                            <td><?php echo $usuario[1] ?></td>
                            <td><?php echo $usuario[2] ?></td>
                            <td><?php echo $usuario[3] ?></td>
                            <td><?php echo $usuario[4] ?></td>
                            <td><?php echo $usuario[5] ?></td>
                            <td>
                              <!-- Botones de modificar y eliminar -->
                              <a href="./detalles_usuario.php?id=<?php echo $usuario[0]; ?>" class="button radius tiny secondary">Modificar</a>
                              <a onclick="eventoAlert(<?php echo $usuario[0]; ?>)" class="button radius tiny secondary">Eliminar</a>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      <tr>
                        <td colspan="4"><b>Total de registros: </b> <?php echo sizeof($usuarios) ?> </td> <!-- Se imprime el total de alumnos -->
                      </tr>
                    </tbody>
                  </table>
                <?php else: ?>
                  No hay registros <!-- En caso de que no haya ningún registro en el archivo se mostrará este mensaje -->
                <?php endif ?>
            </div>
          </section>
        </div>
      </div>

    </div>

    <script type="text/javascript">
      //Función para mostrar la alerta de eliminar. Recibe como parámetro el id del usuario a eliminar
      function eventoAlert(id){
        //Se crea la alerta
        swal({
          title: "¿Estás seguro que deseas eliminar a este usuario?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            window.location.href="./delete.php?id="+id; //...se redirecciona a la página de eliminar
          }
        })
      }
    </script>


    <?php require_once('footer.php'); ?>
