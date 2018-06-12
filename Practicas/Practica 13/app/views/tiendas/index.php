<?php
  include_once RUTA_APP . "/views/header.php";
  include_once RUTA_APP . "/models/HomeModel.php"; //Dentro de la clase Home Model está el método para verficiar si el usuario es admin

  //Si el usuario no pertenece a la tienda uno, significa que no es admin
  if($home->getTiendaUsuario($_SESSION["id"]) != 1 ){
    //Se utiliza javascript para redireccionar al inicio
    ?>
    <script>
      window.location.href="<?php echo RUTA_URL ?>/public/home/index/";
    </script>
    <?php
  }

?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tiendas
        <small>tiendas</small>
      </h1>
    </section>


<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <?php if(!empty($data)): ?>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $tienda): ?>
                      <?php
                        //Se comprueba el estado de la tienda y dependiendo de eso se le da el valor al botón de activar o desactivar
                        if($tienda[3] == 0){
                          $estado = "Activar";
                          $estado2 = "Desactivada";
                        }
                        else{
                          $estado = "Desactivar";
                          $estado2 = "Activada";
                        }
                      ?>
                      <tr>
                        <td><?php echo $tienda[1] ?></td>
                        <td><?php echo $tienda[2] ?></td>
                        <td><?php echo $estado2 ?></td>
                        <td>
                          <a href="<?php echo RUTA_URL ?>/public/tiendas/editar/<?php echo $tienda[0] ?>" class="btn btn-group-vertical btn-primary">Modificar</a>
                          <button name="eliminar" value="<?php echo $tienda[0] ?>" class="btn btn-group-vertical btn-danger">Eliminar</button>
                          <a href="<?php echo RUTA_URL ?>/public/tiendas/entrar/<?php echo $tienda[0] ?>" class="btn btn-group-vertical bg-maroon">Entrar</a>
                          <a href="<?php echo RUTA_URL ?>/public/tiendas/activar/<?php echo $tienda[0] ?>" class="btn btn-group-vertical bg-navy"><?php echo $estado ?></a>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else: ?>
              <p>No hay registros</p> <!-- En caso de que no haya ningún registro en la base de datos se mostrará este mensaje -->
              <?php endif ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- Input para almacenar la contraseña -->
    <input type="hidden" id="clave" value="<?php echo $_SESSION["password"] ?>">


    <?php include_once RUTA_APP . "/views/footer.php"; ?>

<script type="text/javascript">
  var botones = document.getElementsByName("eliminar"); //Array con todos los botones de eliminar
  var clave = document.getElementById("clave").value; //Se obtiene la contraseña desde el input

  //Para cada botón del array
  for(var i=0; i<botones.length; i++){
    (function (boton){
      //Si se da clic al botón
      boton.onclick = function (){
        //Se crea la alerta
        swal({
          title: "¿Estás seguro que deseas eliminar esta tienda?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            //Se muestra el mensaje de confirmación por contraseña
            swal({
              title: "Ingresa tu contraseña para confirmar",
              icon: "warning",
              button: "Aceptar",
              content: "input",
              inputType: "password",
            })
            .then((value) => {
              //Se valida que la contraseña ingresada sea correcta
              if(md5(value) == clave){
                window.location.href="<?php echo RUTA_URL ?>/public/tiendas/eliminar/"+boton.value; //...se redirecciona para eliminar al alumno
              }
              else{
                swal("La contraseña es incorrecta");
              }
            })
          }
        })
      };
    })(botones[i]); //Se pasa como argumento el botón en la posición i
  }
</script>
