<?php include_once RUTA_APP . "/views/header.php"; ?>

<div class="row">
  <!-- Formulario para modificar los datos del usuario. Se agrega un value en los input para mostrar la información del usuario -->
  <div class="large-9 columns">
    <h3>Editar tutoría</h3>
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
            <form class="form-validation" id="formulario" action="<?php echo RUTA_URL?>/public/tutorias/editarTutoria" method="post">
              <div class="form-group">
                  <input type="hidden" name="id" value="<?php echo $data[0][0]?>">
              </div>
              <div class="form-group">
                  <label for="carrera">Alumno</label>
                  <select class="form-control" name="alumno" id="alumno">
                      <?php foreach($data[1] as $alumno): ?>
                        <option value="<?php echo $alumno[0]; ?>" <?php if($data[0][1]==$alumno[0]) echo "selected" ?>><?php echo $alumno[1]; ?></option>
                      <?php endforeach ?>
                  </select>
              </div>
              <div class="form-group">
                  <label for="carrera">Tutor</label>
                  <select class="form-control" name="tutor" id="tutor">
                    <?php foreach($data[2] as $tutor): ?>
                      <option value="<?php echo $tutor[0]; ?>" <?php if($data[0][2]==$tutor[0]) echo "selected" ?>><?php echo $tutor[1]; ?></option>
                    <?php endforeach ?>
                  </select>
              </div>
              <div class="form-group">
                  <label for="alumno">Fecha</label>
                  <input type="date" name="fecha" id="fecha" placeholder="Fecha" value="<?php echo $data[0][3] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="tutor">Hora</label>
                  <input type="text" name="hora" id="hora" placeholder="hh:mm" value="<?php echo $data[0][4] ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="tutor">Tipo de tutoría</label>
                  <select class="form-control" name="tipo" id="tipo">
                        <option value="Individual" <?php if($data[0][5]=="Individual") echo "selected"?>>Individual</option>
                        <option value="Grupal" <?php if($data[0][5]=="Grupal") echo "selected"?>>Grupal</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="tutor">Descripción</label>
                  <textarea name="descripcion" rows="8" cols="80"> <?php echo $data[0][6] ?></textarea>
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
