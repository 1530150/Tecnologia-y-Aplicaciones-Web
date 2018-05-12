<?php
  require_once("database_details.php"); //Se importa el archivo con las funciones

  //Se valida que lo que pase por el método POST sea un equipo que existe
  if(($_GET["equipo"] != "Fútbol") && ($_GET["equipo"] != "Basquetbol")){
    echo "adasdasd";
    header("Location: index.php");
  }

  //Se comprueba que la variable $_POST esté definida
  if(!empty($_POST)){
    //Se ejecuta la función para agregar al jugador
    agregarJugador($_POST["id"], $_POST["nombre"], $_POST["equipo"], $_POST["posicion"], $_POST["carrera"], $_POST["email"]);

    header("Location: index.php"); //Se redirecciona al index
  }

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
      <!-- Formulario para capturar los datos del jugador -->
      <div class="large-9 columns">
        <h3>Agregar nuevo jugador al equipo de <?php echo $_GET["equipo"]; ?></h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
                <form class="form-validation" id="formulario" action="" method="post">
                  <div class="form-group">
                      <label for="id">Número del jugador</label>
                      <input type="text" name="id" id="id" placeholder="Número del jugador" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="hidden" name="equipo" id="equipo" value="<?php echo $_GET['equipo']; ?>">
                  </div>
                  <div class="form-group">
                      <label for="posicion">Posición</label>
                      <input type="text" name="posicion" id="posicion" placeholder="Posición" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="carrera">Carrera</label>
                      <select class="form-control" name="carrera" id="carrera">
                          <option value="Ingeniería en Tecnologías de la Información">Ingeniería en Tecnologías de la Información</option>
                          <option value="Ingeniería en Mecatrónica">Ingeniería en Mecatrónica</option>
                          <option value="Licenciatura en Administración y Gestión de PYMES">Licenciatura en Administración y Gestión de PYMES</option>
                          <option value="Ingeniería en Tecnologías de Manufactura">Ingeniería en Tecnologías de Manufactura</option>
                          <option value="Ingeniería en Sistemas Automotrices">Ingeniería en Sistemas Automotrices</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="email">Correo electrónico</label>
                      <input type="text" name="email" id="email" placeholder="Correo electrónico" class="form-control">
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
          title: "Usuario registrado correctamente",
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
