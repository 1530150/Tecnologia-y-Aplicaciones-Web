<?php
  require_once("database_details.php"); //Se importa el archivo con las funciones

  //Se comprueba si se ha iniciado sesión
  if(!sesionIniciada()){
    //Se comprueba si hay una cookie guardada
    if(isset($_COOKIE["usuario"])){
      //Si es así entonces se inicia sesión con los datos guardados en la cookie
      session_start();
      $_SESSION["usuario"] = $_COOKIE["usuario"];
      setcookie("usuario", $_SESSION["usuario"], time()+(60*60*24*365));
      header("location: formVenta.php"); //Si no se llevará al login //Se actualiza la página
    }
    else{
      header('Location: login.php'); //Si no se llevará al login
    }
  }

  $productos = getProductos(); //Se obtienen todos los productos

  //Se comprueba que la variable $_POST esté definida
  if(!empty($_POST)){
    //Se ejecuta la función para agregar al jugador
    agregarProductoVenta($_POST["producto"], $_POST["cantidad"]);

    header("Location: index.php"); //Se redirecciona al index
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
      <!-- Formulario para capturar los datos del jugador -->
      <div class="large-9 columns">
        <h3>Agregar nuevo producto</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
                <form class="form-validation" id="formulario" action="" method="post">
                  <div class="form-group">
                      <label for="producto">Producto</label>
                      <select class="form-control" name="producto" id="producto">
                          <?php foreach($productos as $producto): ?>
                          <option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
                          <?php endforeach ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="precio">Cantidad</label>
                      <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control">
                  </div>
                  <div class="form-group text-right m-b-0">
                      <button class="btn btn-primary waves-effect waves-light" type="submit" onclick="validar();">
                          Agregar
                      </button>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>

    </div>

    <script type="text/javascript">
      formulario = document.getElementById("formulario"); //Se obtiene el formulario

      function validar(){
        event.preventDefault(); //Se aborta el evento submit del formulario
        llenos = 0; //Variable para contar los campos llenados

        //Se comprueba cada campo para ver si se escribió algo
        if(formulario.producto.value != 0){
          llenos++;
        }

        if(formulario.cantidad.value != 0){
          llenos++;
        }

        //Si no todos los campos están llenos...
        if(llenos < 2){
          //...se mostrará una alerta diciéndolo
          swal({
            text: "Debes llenar todos los campos",
            button: "Aceptar"
          });
        }else{
          eventoAlert(); //Si todos los campos están llenos se ejecuta la función para mostrar la alerta de "success"
        }
      }

      //Función para mostrar la alerta
      function eventoAlert(){
        //Se crea la alerta
        swal({
          title: "¿Agregar producto a la venta?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            formulario.submit(); //...se ejecuta el evento submit del formulario
          }
        })
      }
    </script>


    <?php require_once('footer.php'); ?>
