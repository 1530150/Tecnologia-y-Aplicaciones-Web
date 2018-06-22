<?php
  //Se comprueba si hay una sesión iniciada
  if(Home::sesionIniciada()){
    header("Location: " . RUTA_URL . "/public/home/index"); //Si la hay manda al inicio
  }
?>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo NOMBRE_SITIO?></title>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/css/foundation.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="row">
      <!-- Formulario para capturar los datos del usuario -->
      <div class="large-9 columns" style="width: 300px; float: left; margin-left: 350px; padding-top: 100px;">
        <h3 align="center">Iniciar sesión</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
                <form class="form-validation" id="formulario" action="<?php echo RUTA_URL?>/public/home/admin" method="post">
                  <div class="form-group">
                      <label for="usuario">Usuario</label>
                      <input type="text" name="usuario" id="usuario" placeholder="Usuario" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="clave">Contraseña</label>
                      <input type="password" name="clave" id="clave" placeholder="Contraseña" class="form-control">
                  </div>
                  <!-- Si se pasó el parametro "mal" se imprime un mensaje de usuario o contraseña incorrectos -->
                  <?php if($data == "mal"): ?>
                    <div class="form-group has-feedback">
                      <p style="color: red;">Usuario o contraseña incorrectos</p>
                    </div>
                  <?php endif ?>
                  <div class="form-group m-b-0" align="center">
                      <button class="btn btn-primary waves-effect waves-light" type="submit" onclick="validar();">
                          Enviar
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
        if(formulario.usuario.value != 0){
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
    </script>

<?php include_once RUTA_APP . "/views/footer.php"; ?>
