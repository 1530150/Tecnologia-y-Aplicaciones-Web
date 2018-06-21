<?php
  include_once RUTA_APP . "/views/header.php";
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
          <?php /*if(!empty($data)):*/ if(TRUE):?>
              <table>
                <thead>
                  <tr>
                    <!-- Datos de los alumnos -->
                    <th>ID</th>
                    <th>Nombre alumna</th>
                    <th>Grupo</th>
                    <th>Nombre mama</th>
                    <th>Fecha de pago</th>
                    <th>Fecha de envío</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ciclo para imprimir todas las carreras y su respectiva información -->
                  <?php foreach($data as $lugar): ?>
                      <tr>
                        <td><?php echo "asdsd" ?></td>
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

<script type="text/javascript">
  var botones = document.getElementsByName("eliminar"); //Array con todos los botones de eliminar

  //Para cada botón del array
  for(var i=0; i<botones.length; i++){
    (function (boton){
      //Si se da clic al botón
      boton.onclick = function (){
        //Se crea la alerta
        swal({
          title: "¿Estás seguro que deseas eliminar esta carrera?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            window.location.href="<?php echo RUTA_URL ?>/public/carreras/eliminarCarrera/"+boton.value; //...se redirecciona para eliminar a la carrera
          }
        })
      };
    })(botones[i]); //Se pasa como argumento el botón en la posición i
  }
</script>

<?php include_once RUTA_APP . "/views/footer.php"; ?>
