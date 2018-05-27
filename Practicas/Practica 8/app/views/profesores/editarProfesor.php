<?php
  include_once RUTA_APP . "/views/header.php";

  //Si el usuario no es admin
  if(!HomeModel::esAdmin()){
    header("Location: " . RUTA_URL . "/public/home/"); //Lo manda al inicio
  }

?>

<div class="row">
  <!-- Formulario para modificar los datos del usuario. Se agrega un value en los input para mostrar la información del usuario -->
  <div class="large-9 columns">
    <h3>Editar alumno</h3>
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
            <form class="form-validation" id="formulario" action="<?php echo RUTA_URL?>/public/profesores/editarProfesor" method="post">
              <div class="form-group">
                  <input type="hidden" name="numEmp" id="numEmp" value="<?php echo $data[0][0] ?>" class="form-control" readonly>
              </div>
              <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $data[0][1] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="nombre">Contraseña</label>
                  <input type="password" name="password" id="password" placeholder="Contraseña" value="<?php echo $data[0][4] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="password">Tipo</label>
                  <select class="form-control" name="tipo" id="tipo">
                    <option value="Usuario">Usuario</option>
                    <option value="Usuario" <?php if($data[0][2]=="Usuario") echo "selected" ?>>Usuario</option>
                    <option value="Administrador" <?php if($data[0][2]=="Administrador") echo "selected" ?>>Administrador</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="email">Correo electrónico</label>
                  <input type="text" name="email" id="email" placeholder="Correo electrónico" value="<?php echo $data[0][3] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="carrera">Carrera</label>
                  <select class="form-control" name="carrera" id="carrera">
                      <?php foreach($data[1] as $carrera): ?>
                        <option value="<?php echo $carrera[0]; ?>" <?php if($data[0][4]==$carrera[0]) echo "selected" ?>><?php echo $carrera[1]; ?></option>
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

<script type="text/javascript">
formulario = document.getElementById("formulario"); //Se obtiene el formulario

  function validar(){
    event.preventDefault(); //Se aborta el evento submit del formulario
    llenos = 0; //Variable para contar los campos llenados

    //Se comprueba cada campo para ver si se escribió algo
    if(formulario.nombre.value != 0){
      llenos++;
    }

    if(formulario.password.value != 0){
      llenos++;
    }

    if(formulario.tipo.value != 0){
      llenos++;
    }

    if(formulario.email.value != 0){
      llenos++;
    }

    if(formulario.carrera.value!=0){
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
      title: "Profesor modificado correctamente",
      icon: "success",
      button: "Aceptar",
    })
    //Si se dio clic en aceptar en la alerta...
    .then((value) => {
      formulario.submit(); //...se ejecuta el evento submit del formulario
    })
  }
</script>
<?php include_once RUTA_APP . "/views/footer.php"; ?>
