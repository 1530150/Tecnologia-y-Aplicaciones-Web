<?php
  include_once RUTA_APP . "/views/header.php";

  //Se comprueba si hay una sesión iniciada
  if(Home::sesionIniciada()){
    header("Location: " . RUTA_URL . "/public/home/pagos/"); //Si la hay manda al inicio
  }

?>

<div class="large-12 columns" align="center">
  <h4>Formulario de envío de Comprobantes</h4>
  <h4>Festival Verano 2018</h4>
</div>

<div class="row">
  <hr>
  <!-- Formulario para modificar los datos del usuario. Se agrega un value en los input para mostrar la información del usuario -->
  <div class="large-9 columns">
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
            <form class="form-validation" id="formulario" action="<?php echo RUTA_URL?>/public/home/agregarPago" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="carrera">Grupo:</label>
                <select class="form-control" name="grupo" id="grupo">
                  <?php foreach($data[0] as $grupo): ?>
                    <option value="<?php echo $grupo[0]?>"><?php echo $grupo[1]?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="carrera">Alumnas:</label>
                <select class="form-control" name="alumna" id="alumna">
                  <?php foreach($data[1] as $alumna): ?>
                    <option value="<?php echo $alumna[0]?>"><?php echo $alumna[1]?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="nombre_mama">Nombre de la mamá:</label>
                <div class="" style="display: flex; flex-direction: row;">
                  <input type="text" name="nombre_mama" id="nombre_mama" placeholder="Nombre" class="form-control">
                  <div style="padding: 10px;"></div>
                  <input type="text" name="apellido_mama" id="apellido_mama" placeholder="Apellido" class="form-control">
                </div>
              </div>
              <div class="form-group" style="clear: left;">
                  <label for="fecha_pago">Fecha de pago:</label>
                  <input type="date" name="fecha_pago" id="fecha_pago" class="form-control">
              </div>
              <div class="form-group" style="clear: left;">
                  <label for="nombre_mama">Folio de autorización:</label>
                  <input type="text" name="folio" id="folio" placeholder="Folio de autorización" class="form-control">
              </div>
              <div class="form-group" style="clear: left;">
                  <label for="nombre_mama">Comprobante de folio:</label>
                  <input type="file" name="folio_img" id="folio_img" class="form-control">
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


<?php include_once RUTA_APP . "/views/footer.php"; ?>

<script type="text/javascript">
  formulario = document.getElementById("formulario"); //Se obtiene el formulario

  function validar(){
    event.preventDefault(); //Se aborta el evento submit del formulario
    llenos = 0; //Variable para contar los campos llenados

    //Se comprueba cada campo para ver si se escribió algo
    if(formulario.nombre_mama.value != 0){
      llenos++;
    }

    if(formulario.apellido_mama.value != 0){
      llenos++;
    }

    if(formulario.fecha_pago.value != 0){
      llenos++;
    }

    if(formulario.folio.value != 0){
      llenos++;
    }

    if(formulario.folio_img.value != 0){
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
      title: "Registro enviado correctamente",
      icon: "success",
      button: "Aceptar",
    })
    //Si se dio clic en aceptar en la alerta...
    .then((value) => {
      formulario.submit(); //...se ejecuta el evento submit del formulario
    })
  }
</script>
