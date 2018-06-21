<?php include_once RUTA_APP . "/views/header.php"; ?>

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
            <form class="form-validation" id="formulario" action="<?php echo RUTA_URL?>/public/carreras/agregarCarrera" method="post">
              <div class="form-group">
                <label for="carrera">Grupo:</label>
                <select class="form-control" name="grupo" id="grupo">
                  <option class="js-example-basic-single" value="<?php echo "asd" ?>"><?php echo "asd"; ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="carrera">Alumna:</label>
                <select class="form-control" name="alumna" id="alumna">
                  <option class="js-example-basic-single" value="<?php echo "asd" ?>"><?php echo "asd"; ?></option>
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
