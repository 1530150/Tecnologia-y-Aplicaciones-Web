<?php
  require_once("database_details.php"); //Se importa el archivo con las funciones

  //Se comprueba que la variable $_POST esté definida, para saber si es la primera vez o la segunda que se entra a la página
  if(empty($_POST)){
    $usuario = getUsuario($_GET["id"]); //Se obtiene el id del usuario pasado por el método GET
  }else{
    //Se ejecuta la función para modificar al usuario
    modificarUsuario($_POST["id"], $_POST["nombre"], $_POST["edad"], $_POST["correo"], $_POST["telefono"], $_POST["direccion"]);

    header("Location: index.php"); //Se redirecciona al index
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>

    <?php require_once('header.php'); ?>


    <div class="row">
      <!-- Formulario para modificar los datos del usuario. Se agrega un value en los input para mostrar la información del usuario -->
      <div class="large-9 columns">
        <h3>Agregar nuevo usuario</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
                <form class="form-validation" id="formulario" action="" method="post">
                  <input type="hidden" name="id" value="<?php echo $usuario[0] ?>">

                  <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $usuario[1] ?>" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="edad">Edad</label>
                      <input type="text" name="edad" id="edad" placeholder="Edad" value="<?php echo $usuario[2] ?>" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="correo">Correo electrónico</label>
                      <input type="text" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $usuario[3] ?>" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="telefono">Teléfono</label>
                      <input type="text" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $usuario[4] ?>" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="direccion">Dirección</label>
                      <input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $usuario[5] ?>" class="form-control">
                  </div>
                  <div class="form-group text-right m-b-0">
                      <button class="btn btn-primary waves-effect waves-light" type="submit" onclick="validar();">
                          Guardar
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
        if(formulario.nombre.value != 0){
          llenos++;
        }

        if(formulario.edad.value != 0){
          llenos++;
        }

        if(formulario.correo.value != 0){
          llenos++;
        }

        if(formulario.telefono.value!=0){
          llenos++;
        }

        if(formulario.direccion.value!=0){
          llenos++;
        }

        //Si no todos los campos están llenos...
        if(llenos < 5){
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
          title: "Usuario modificado correctamente",
          icon: "success",
          button: "Aceptar",
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          formulario.submit(); //...se ejecuta el evento submit del formulario
        })
      }
    </script>


    <?php require_once('footer.php'); ?>
