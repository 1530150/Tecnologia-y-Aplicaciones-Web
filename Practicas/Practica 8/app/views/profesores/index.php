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

          <h3>Lista de Profesores</h3>
          <a href="<?php echo RUTA_URL?>/public/profesores/agregarProfesor" class="button">Agregar nuevo</a>
          <!-- Se verifica que el arreglo de alumnos no esté vacío -->
          <?php if(!empty($data)): ?>
              <table>
                <thead>
                  <tr>
                    <!-- Datos de los alumnos -->
                    <th>Número de empleado</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Correo electrónico</th>
                    <th>Carrera</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ciclo para imprimir todos los profesores y su respectiva información -->
                  <?php foreach($data as $profesor): ?>
                      <tr>
                        <td width="100"><?php echo $profesor[0] ?></td>
                        <td><?php echo $profesor[1] ?></td>
                        <td><?php echo $profesor[2] ?></td>
                        <td><?php echo $profesor[3] ?></td>
                        <td><?php echo $profesor[4] ?></td>
                        <td width="200">
                          <!-- Botones de modificar y eliminar -->
                          <a href="<?php echo RUTA_URL ?>/public/profesores/editarProfesor/<?php echo $profesor[0] ?>" class="button radius tiny secondary">Modificar</a>
                          <button name="eliminar" value="<?php echo $profesor[0] ?>" class="button radius tiny secondary">Eliminar</buttoon>
                        </td>
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
          title: "¿Estás seguro que deseas eliminar a este profesor?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            window.location.href="<?php echo RUTA_URL ?>/public/profesores/eliminarProfesor/"+boton.value; //...se redirecciona para eliminar al profesor
          }
        })
      };
    })(botones[i]); //Se pasa como argumento el botón en la posición i
  }
</script>

<?php include_once RUTA_APP . "/views/footer.php"; ?>
