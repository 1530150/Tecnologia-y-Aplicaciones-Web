<?php
  require_once("database_details.php");

  //Se valida que lo que pase por el método POST sea un equipo que existe
  if(($_GET["equipo"] != "Fútbol") && ($_GET["equipo"] != "Basquetbol")){
    echo "adasdasd";
    header("Location: index.php");
  }

  $jugadores = getJugadores($_GET["equipo"]); //Se obtienen todos los jugadores del equipo
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
              </div>

              <!-- Se verifica que el arreglo de usuarios no esté vacío -->
              <?php if(!empty($jugadores)): ?>
                  <h3>Lista de jugadores del equipo de <?php echo $_GET["equipo"] ?></h3>
                  <table>
                    <thead>
                      <tr>
                        <!-- Datos de los alumnos -->
                        <th width="200">Número</th>
                        <th width="500">Nombre</th>
                        <th width="250">Posición</th>
                        <th width="250">Carrera</th>
                        <th width="250">Correo electrónico</th>
                        <th width="500">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Ciclo para imprimir todos los alumnos y su respectiva información -->
                      <?php foreach($jugadores as $jugador): ?>
                          <tr>
                            <td><?php echo $jugador[0] ?></td>
                            <td><?php echo $jugador[1] ?></td>
                            <td><?php echo $jugador[3] ?></td>
                            <td><?php echo $jugador[4] ?></td>
                            <td><?php echo $jugador[5] ?></td>
                            <td>
                              <!-- Botones de modificar y eliminar -->
                              <a href="./modificar_jugador.php?id[]=<?php echo $jugador[0]; ?>&id[]=<?php echo $jugador[2]; ?>" class="button radius tiny secondary">Modificar</a>
                              <a onclick="eventoAlert(<?php echo $jugador[0]; ?>, '<?php echo $jugador[2]; ?>')" class="button radius tiny secondary">Eliminar</a>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      <tr>
                        <td colspan="4"><b>Total de registros: </b> <?php echo getNumJugadores($_GET["equipo"]); ?> </td> <!-- Se imprime el total de alumnos -->
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
      function eventoAlert(id, equipo){
        //Se crea la alerta
        swal({
          title: "¿Estás seguro que deseas eliminar a este jugador?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            window.location.href="./delete.php?id[]="+id+"&id[]="+equipo; //...se redirecciona a la página de eliminar pasando el núm de jugador y el equipo
          }
        })
      }
    </script>


    <?php require_once('footer.php'); ?>
