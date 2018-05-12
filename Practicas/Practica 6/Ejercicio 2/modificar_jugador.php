<?php
  require_once("database_details.php"); //Se importa el archivo con las funciones

  //Se comprueba que la variable $_POST esté definida, para saber si es la primera vez o la segunda que se entra a la página
  if(empty($_POST)){
    $jugador = getJugador($_GET["id"][0], $_GET["id"][1]); //Se obtiene el id del usuario pasado por el método GET
  }else{
    //Se ejecuta la función para modificar al usuario
    modificarJugador($_POST["id"], $_POST["nombre"], $_POST["equipo"], $_POST["posicion"], $_POST["carrera"], $_POST["email"]);

    header("Location: jugadores.php?equipo=".$_POST['equipo']); //Se redirecciona a la lista de jugadores
  }

  //Arrays de carreras en su respectivo select
  $carreras = array("Ingeniería en Tecnologías de la Información", "Ingeniería en Mecatrónica", "Licenciatura en Administración y Gestión de PYMES", "Ingeniería en Tecnologías de Manufactura", "Ingeniería en Sistemas Automotrices");

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
      <!-- Formulario para modificar los datos del usuario. Se agrega un value en los input para mostrar la información del usuario -->
      <div class="large-9 columns">
        <h3>Agregar nuevo usuario</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
                <form class="form-validation" id="formulario" action="" method="post">
                  <div class="form-group">
                      <label for="id">Número del jugador</label>
                      <input type="text" name="id" id="id" placeholder="Número del jugador" value="<?php echo $jugador["id"] ?>" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $jugador["nombre"] ?>" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="hidden" name="equipo" id="equipo" value="<?php echo $jugador["equipo"]; ?>">
                  </div>
                  <div class="form-group">
                      <label for="posicion">Posición</label>
                      <input type="text" name="posicion" id="posicion" placeholder="Posición" value="<?php echo $jugador["posicion"] ?>" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="carrera">Carrera</label>
                      <select class="form-control" name="carrera" id="carrera">
                          <?php foreach($carreras as $carrera): ?>
                            <option value="<?php echo $carrera; ?>" <?php if($jugador["carrera"]==$carrera) echo "selected" ?>><?php echo $carrera; ?></option>
                          <?php endforeach ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="email">Correo electrónico</label>
                      <input type="text" name="email" id="email" placeholder="Correo electrónico" value="<?php echo $jugador["email"] ?>" class="form-control">
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
        if(formulario.id.value != 0){
          llenos++;
        }

        if(formulario.nombre.value != 0){
          llenos++;
        }

        if(formulario.equipo.value != 0){
          llenos++;
        }

        if(formulario.posicion.value!=0){
          llenos++;
        }

        if(formulario.carrera.value!=0){
          llenos++;
        }

        if(formulario.email.value!=0){
          llenos++;
        }

        //Si no todos los campos están llenos...
        if(llenos < 6){
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
          title: "¿Guardar cambios?",
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
