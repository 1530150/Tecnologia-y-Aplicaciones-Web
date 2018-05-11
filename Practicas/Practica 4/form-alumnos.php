
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>

    <?php require_once('header.php'); ?>


    <div class="row">
      <!-- Formulario para capturar un alumno -->
      <div class="large-9 columns">
        <h3>Agregar nuevo alumno</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
                <form class="form-validation" action="guardar/guardarAlumno.php" method="post">
                  <div class="form-group">
                      <label for="clave">Matrícula</label>
                      <input type="text" name="matricula" placeholder="Matrícula" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="clave">Nombre></label>
                      <input type="text" name="nombre" placeholder="Nombre" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="clave">Carrera</label>
                      <input type="text" name="carrera" placeholder="Carrera" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="clave">Correo electrónico</label>
                      <input type="text" name="email" placeholder="Correo electrónico" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="clave">Teléfono</label>
                      <input type="text" name="telefono" placeholder="Teléfono" class="form-control">
                  </div>
                  <div class="form-group text-right m-b-0">
                      <button class="btn btn-primary waves-effect waves-light" type="submit">
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


    <?php require_once('footer.php'); ?>
