<?php
  include_once RUTA_APP . "/views/header.php";

  //Si el usuario no es admin
  if(!HomeModel::esAdmin()){
    header("Location: " . RUTA_URL . "/public/home/"); //Lo manda al inicio
  }

?>

<div class="row">
  <div class="large-12 columns">
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
          </div>

          <h3>Lista de Tutorías realizadas</h3>
          <a href="<?php echo RUTA_URL?>/public/tutorias/agregarTutoria/<?php echo $data[1] ?>" class="button">Agregar nueva</a>
          <!-- Se verifica que el arreglo de tutorías no esté vacío -->
          <?php if(!empty($data)): ?>
              <table>
                <thead>
                  <tr>
                    <!-- Datos de la tutoría-->
                    <th>Alumno(s)</th>
                    <th>Tutor</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo de tutoría</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ciclo para imprimir todos los alumnos y su respectiva información -->
                  <?php foreach($data[0] as $tutoria): ?>
                      <tr>
                        <td width="200"><?php echo $tutoria[0] ?></td>
                        <td width="200"><?php echo $tutoria[1] ?></td>
                        <td><?php echo $tutoria[2] ?></td>
                        <td><?php echo $tutoria[3] ?></td>
                        <td><?php echo $tutoria[4] ?></td>
                        <td width="300"><?php echo $tutoria[5] ?></td>
                      </tr>
                    <?php endforeach ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>No hay registros</p> <!-- En caso de que no haya ningún registro en la base de datos se mostrará este mensaje -->
            <?php endif ?>
        </div>
      </section>
    </div>
  </div>
</div>
<?php include_once RUTA_APP . "/views/footer.php"; ?>
