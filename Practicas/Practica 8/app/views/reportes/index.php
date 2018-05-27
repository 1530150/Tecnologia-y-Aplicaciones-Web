<?php include_once RUTA_APP . "/views/header.php"; ?>

<div class="row">
  <div class="large-12 columns">
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
          </div>

          <h3>Mis tutorías realizadas</h3>
          <!-- Se verifica que el arreglo de tutorías no esté vacío -->
          <?php if(!empty($data[0])): ?>
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
              <p>No hay registros de tutorías</p> <!-- En caso de que no haya ningún registro en la base de datos se mostrará este mensaje -->
            <?php endif ?>
        </div>
        <br>
        <br>
        <br>
        <div class="content" data-slug="panel1">
          <div class="row">
          </div>

          <h3>Mis alumnos</h3>
          <!-- Se verifica que el arreglo de alumnos no esté vacío -->
          <?php if(!empty($data[1])): ?>
              <table>
                <thead>
                  <tr>
                    <!-- Datos de los alumnos -->
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Tutor</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ciclo para imprimir todos los alumnos y su respectiva información -->
                  <?php foreach($data[1] as $alumno): ?>
                      <tr>
                        <td><?php echo $alumno[0] ?></td>
                        <td><?php echo $alumno[1] ?></td>
                        <td><?php echo $alumno[2] ?></td>
                        <td><?php echo $alumno[3] ?></td>
                      </tr>
                    <?php endforeach ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>No hay registros de alumnos</p> <!-- En caso de que no haya ningún registro en la base de datos se mostrará este mensaje -->
            <?php endif ?>
        </div>
      </section>
    </div>
  </div>
</div>

<?php include_once RUTA_APP . "/views/footer.php"; ?>
