<?php
  include_once RUTA_APP . "/views/header.php";

  //Se comprueba si hay una sesión iniciada
  if(Home::sesionIniciada()){
    header("Location: " . RUTA_URL . "/public/home/pagos/"); //Si la hay manda al inicio
  }
?>


<div class="row">
  <div class="large-12 columns">
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
          </div>

          <div class="large-12 columns" align="center">
            <h4>Orden de envios de Comprobantes</h4>
            <h4>Festival Verano 2018</h4>
          </div>
          <hr>
          <!-- Se verifica que el arreglo de alumnos no esté vacío -->
          <?php if(!empty($data)):?>
              <table>
                <thead>
                  <tr>
                    <!-- Datos de los alumnos -->
                    <th>Lugar</th>
                    <th>Grupo</th>
                    <th>Nombre alumna</th>
                    <th>Nombre mama</th>
                    <th>Fecha de pago</th>
                    <th>Fecha de envío</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ciclo para imprimir todas las lugares y su respectiva información -->
                  <?php foreach($data as $lugar): ?>
                      <tr>
                        <td><?php echo $lugar[0] ?></td>
                        <td><?php echo $lugar[1] ?></td>
                        <td><?php echo $lugar[2] ?></td>
                        <td><?php echo $lugar[3] ?></td>
                        <td><?php echo $lugar[4] ?></td>
                        <td><?php echo $lugar[5] ?></td>
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
