<?php
  include_once RUTA_APP . "/views/header.php";

  /*Si el usuario no es admin
  if(!HomeModel::esAdmin()){
    header("Location: " . RUTA_URL . "/public/home/"); //Lo manda al inicio
  }
  */
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Productos
        <small>Productos</small>
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
                  <th></th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Fecha de agregado</th>
                  <th>Precio</th>
                  <th>Unidades en stock</th>
                  <th>Categoría</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($data as $producto): ?>
                    <tr>
                      <td><img src="<?php echo RUTA_URL . substr($producto[7], 58) ?>" class="img-circle" width="50px" height="50px"></td>
                      <td><?php echo $producto[1] ?></td>
                      <td><?php echo $producto[2] ?></td>
                      <td><?php echo $producto[3] ?></td>
                      <td>$<?php echo $producto[4] ?></td>
                      <td><?php echo $producto[5] ?></td>
                      <td><?php echo $producto[6] ?></td>
                      <td>
                        <a href="<?php echo RUTA_URL ?>/public/productos/editar/<?php echo $producto[0] ?>" class="btn btn-group-vertical btn-primary">Modificar</a>
                        <button name="eliminar" value="<?php echo $producto[0] ?>" class="btn btn-group-vertical btn-danger">Eliminar</button>
                        <a href="<?php echo RUTA_URL?>/public/productos/detalles/<?php echo $producto[0] ?>" type="button" class="btn btn-group-vertical btn-warning">Detalles</a>
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
              title: "¿Estás seguro que deseas eliminar este producto?",
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
                    window.location.href="<?php echo RUTA_URL ?>/public/productos/eliminar/"+boton.value; //...se redirecciona para eliminar al alumno
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
