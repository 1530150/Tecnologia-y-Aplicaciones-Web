<?php
  require_once("database_details.php"); //Se importa el archivo con las funciones

  //Se comprueba si se ha iniciado sesión
  if(sesionIniciada()){
    header('Location: index.php'); //Si sí se llevará al index
  }
  else{ //Se comprueba si hay una cookie guardada
    if(isset($_COOKIE["usuario"])){
      //Si es así entonces se inicia sesión con los datos guardados en la cookie
      session_start();
      $_SESSION["usuario"] = $_COOKIE["usuario"];
      setcookie("usuario", $_SESSION["usuario"], time()+(60*60*24*365));
      header("Location: login.php");
    }
  }

  //Se comprueba que la variable $_POST esté definida
  if(!empty($_POST)){
    //Se valida el inicio de sesión
    if(validarLogin($_POST["nombre"], $_POST["clave"])){
      //Si el usuario existe, entonces se inicia la sesión, se crea una cookie para mantener la sesion y se manda al index
      setcookie("usuario", $_POST["nombre"], time()+(60*60*24*365));
      header('Location: index.php');
    }
    else{
    ?>
      <script>
        alert("El nombre de usuario o la contraseña son incorrectos");
        location.href = "login.php";
      </script>
    <?php
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
    <div style="padding: 50px;">
      <!-- Solo para hacer espacio -->
    </div>

    <div class="row">
      <!-- Formulario para capturar los datos del usuario -->
      <div class="large-9 columns" style="width: 300px; float: left; margin-left: 350px;">
        <h3 align="center">Iniciar sesión</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
                <form class="form-validation" id="formulario" action="" method="post">
                  <div class="form-group">
                      <label for="nombre">Nombre de usuario</label>
                      <input type="text" name="nombre" id="nombre" placeholder="Nombre de usuario" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="clave">Contraseña</label>
                      <input type="password" name="clave" id="clave" placeholder="Contraseña" class="form-control">
                  </div>
                  <div class="form-group m-b-0" align="center">
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

        if(formulario.clave.value != 0){
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
          formulario.submit(); //...se ejecuta el evento submit del formulario
        }
      }

      function eventoAlert(){
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
