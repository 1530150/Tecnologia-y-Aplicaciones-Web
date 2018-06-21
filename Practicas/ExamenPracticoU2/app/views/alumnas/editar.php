<?php
  include_once RUTA_APP . "/views/header.php";
/*
  //Si el usuario no es admin
  if(!HomeModel::esAdmin()){
    header("Location: " . RUTA_URL . "/public/home/"); //Lo manda al inicio
  }
*/
?>


<div class="row">
  <!-- Formulario para modificar los datos de la alumna. Se agrega un value en los input para mostrar la información de la alumna -->
  <div class="large-9 columns">
    <h3>Editar alumna</h3>
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
            <form class="form-validation" id="formulario" action="<?php echo RUTA_URL?>/public/alumnas/editar" method="post">
              <div class="form-group">
                  <input type="hidden" name="id" id="id" value="<?php echo $data[0][0] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" value="<?php echo $data[0][1] ?>">
              </div>
              <div class="form-group">
                  <label for="nombre">Apellido:</label>
                  <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control" value="<?php echo $data[0][2] ?>">
              </div>
              <div class="form-group" style="clear: left;">
                  <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                  <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo $data[0][3] ?>">
              </div>
              <div class="form-group">
                <label for="carrera">Grupo:</label>
                <select class="form-control" name="grupo" id="grupo">
                  <?php foreach($data[1] as $grupo): ?>
                    <option value="<?php echo $grupo[0]?>" <?php if($data[0][4]==$grupo[0]) echo "selected" ?>><?php echo $grupo[1]?></option>
                  <?php endforeach ?>
                </select>
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
    if(formulario.nombre.value != 0){
      llenos++;
    }

    //Si no todos los campos están llenos...
    if(llenos < 1){
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
      title: "Alumna modificada correctamente",
      icon: "success",
      button: "Aceptar",
    })
    //Si se dio clic en aceptar en la alerta...
    .then((value) => {
      formulario.submit(); //...se ejecuta el evento submit del formulario
    })
  }
</script>
