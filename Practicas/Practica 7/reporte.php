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
      header("Location: reporte.php"); //Se actualiza la página
    }
    else{
      header('Location: login.php'); //Si no se llevará al login
    }
  }

  $venta = getVenta(); //Se obtiene la información de la venta
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
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>

              <!-- Se verifica que el arreglo de usuarios no esté vacío -->
              <?php if(!empty($venta)): ?>
                  <h3>Reporte de venta</h3>
                  <table>
                    <thead>
                      <tr>
                        <!-- Datos de los alumnos -->
                        <th width="200">Producto</th>
                        <th width="200">Cantidad</th>
                        <th width="200">Total</th>
                        <th width="200">Promedio de venta del producto</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total = 0; ?> <!-- Para guardar el total de la venta -->
                      <!-- Ciclo para imprimir la tabla con los detalles de la venta -->
                      <?php foreach($venta as $producto): ?>
                          <tr>
                            <td><?php echo $producto[0] ?></td>
                            <td><?php echo $producto[1] ?></td>
                            <td><?php echo '$', $producto[2] ?></td>
                            <td><?php echo '$', ($producto[2] / $producto[1]) ?></td>
                          </tr>
                          <?php $total += $producto[2] ?>
                        <?php endforeach ?>
                      <tr>
                        <td colspan="4"><b>Total ganado en el día: </b> <?php echo '$', $total; ?> </td> <!-- Se imprime el total ganado en el día -->
                      </tr>
                    </tbody>
                  </table>
                <?php else: ?>
                  No hay venta <!-- En caso de que no haya ninguna venta se mostrará este mensaje -->
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
