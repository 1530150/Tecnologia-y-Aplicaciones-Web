<?php
  include_once RUTA_APP . "/views/header.php";
/*
  //Si el usuario no es admin
  if(!HomeModel::esAdmin()){
    header("Location: " . RUTA_URL . "/public/home/"); //Lo manda al inicio
  }
*/
?>


<div class="row">
  <div class="large-12 columns">
    <div class="section-container tabs" data-section>
      <section class="section">
        <div class="content" data-slug="panel1">
          <div class="row">
          </div>

          <h3>Lista de Grupos</h3>
          <a href="<?php echo RUTA_URL?>/public/grupos/agregar" class="button">Agregar nuevo</a>
          <!-- Se verifica que el arreglo de alumnos no esté vacío -->
          <?php if(!empty($data)): ?>
              <table>
                <thead>
                  <tr>
                    <!-- Datos de los alumnos -->
                    <th width="500">Nombre</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ciclo para imprimir todas las grupos y su respectiva información -->
                  <?php foreach($data as $grupo): ?>
                      <tr>
                        <td><?php echo $grupo[1] ?></td>
                        <td>
                          <!-- Botones de modificar y eliminar -->
                          <a href="<?php echo RUTA_URL ?>/public/grupos/editar/<?php echo $grupo[0] ?>" class="button radius tiny secondary">Modificar</a>
                          <button name="eliminar" value="<?php echo $grupo[0] ?>" class="button radius tiny secondary">Eliminar</button>
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
          title: "¿Estás seguro que deseas eliminar esta grupo?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            window.location.href="<?php echo RUTA_URL ?>/public/grupos/eliminar/"+boton.value; //...se redirecciona para eliminar a la grupo
          }
        })
      };
    })(botones[i]); //Se pasa como argumento el botón en la posición i
  }
</script>

<?php include_once RUTA_APP . "/views/footer.php"; ?>
