<?php
  include_once RUTA_APP . "/views/header.php";

  //Si el usuario pertenece a la tienda uno, significa que es admin, el admin no puede acceder aquí
  if($_SESSION["tienda"] == 1 ){
    //Se utiliza javascript para redireccionar al inicio
    ?>
    <script>
      window.location.href="<?php echo RUTA_URL ?>/public/home/index/";
    </script>
    <?php
  }

  $ventasModel = new VentasModel();
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ventas
        <small>Ventas</small>
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
                      <th>Fecha</th>
                      <th>Productos</th>
                      <th>Total</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $venta): ?>
                      <tr>
                        <td><?php echo $venta[1] ?></td>
                        <td>
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- Se obtienen los productos de la venta y posteriormente se imprimen -->
                              <?php $productos = $ventasModel->getDetallesVenta($venta[0]); ?>
                              <?php foreach($productos as $producto):?>
                                <tr>
                                  <td><?php echo $producto[0] ?></td>
                                  <td><?php echo $producto[1] ?></td>
                                </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </td>
                        <td>$<?php echo $venta[2] ?></td>
                        <td>
                          <button name="eliminar" value="<?php echo $venta[0] ?>" class="btn btn-group-vertical btn-danger">Eliminar</button>
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
          title: "¿Estás seguro que deseas eliminar esta venta?",
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
                window.location.href="<?php echo RUTA_URL ?>/public/ventas/eliminar/"+boton.value; //...se redirecciona para eliminar al alumno
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
