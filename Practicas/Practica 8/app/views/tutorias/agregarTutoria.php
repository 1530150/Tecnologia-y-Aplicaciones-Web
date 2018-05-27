<?php include_once RUTA_APP . "/views/header.php"; ?>

<div class="row">
  <!-- Formulario para modificar los datos del usuario. Se agrega un value en los input para mostrar la información del usuario -->
  <div class="large-9 columns">
    <h3>Agregar nueva tutoría</h3>
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
            <form class="form-validation" id="formulario" action="<?php echo RUTA_URL?>/public/tutorias/agregarTutoria" method="post">
              <div class="form-group">
                  <label for="tipo">Tipo de tutoría</label>
                  <input type="text" name="tipo" id="tipo" value="Individual" class="form-control" readonly>
              </div>
              <div class="form-group">
                  <label for="carrera">Alumno</label>
                  <select class="form-control" id="lista_alumnos" readonly>
                      <?php foreach($data[0] as $alumno): ?>
                        <option value="<?php echo $alumno[0]; ?>"><?php echo $alumno[1]; ?></option>
                      <?php endforeach ?>
                  </select>
                  <button type="button" name="button" onclick="agregarAlumno()">Agregar alumno</button>
              </div>
              <div class="form-group">
                  <label for="carrera">Tutor</label>
                  <select class="form-control" name="tutor" id="tutor">
                        <option value="<?php echo $data[1][0]; ?>"><?php echo $data[1][1]; ?></option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="fecha">Fecha</label>
                  <input type="date" name="fecha" id="fecha" placeholder="Fecha" class="form-control">
              </div>
              <div class="form-group">
                  <label for="hora">Hora</label>
                  <input type="text" name="hora" id="hora" placeholder="hh:mm" class="form-control">
              </div>
              <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <textarea name="descripcion" id="descripcion" rows="8" cols="80"></textarea>
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
  var alumnos = 0;
  function agregarAlumno(){
    var select = document.getElementById("lista_alumnos"); //Se obtiene el select de alumnos

    //Se crea un nuevo input tipo hidden en el que se agregará el alumno seleccionado
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "alumno[]";
    input.value = select.value;
    select.parentNode.insertBefore(input, select.nextSibling);
    alumnos++;

    //Si ya hay más de dos alumnos en la tutoría
    if(alumnos >= 2){
        document.getElementById("tipo").value = "Grupal"; //Automáticamente el tipo de tutoría se cambia a grupal
    }

    //Se elimina del select al alumno seleccionado
    for(var i=0; i<select.length; i++){
      if(select.options[i].value == select.value){
        select.removeChild(select.options[i]);
        break;
      }
    }
  }

  function validar(){
    event.preventDefault(); //Se aborta el evento submit del formulario
    llenos = 0; //Variable para contar los campos llenados

    //Se comprueba cada campo para ver si se escribió algo
    if(formulario.tipo.value != 0){
      llenos++;
    }

    if(formulario.tutor.value != 0){
      llenos++;
    }

    if(formulario.fecha.value != 0){
      llenos++;
    }

    if(formulario.hora.value!=0){
      llenos++;
    }

    if(formulario.descripcion.value!=0){
      llenos ++;
    }


    //Si no todos los campos están llenos...
    if(llenos < 5 || alumnos == 0){
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
      title: "Tutoría registrada correctamente",
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
