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
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Detalles del Producto
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
              <h1><?php echo $data[0][2] ?></h1>
              <hr>
                <img src="<?php echo RUTA_URL . substr($data[0][7], 58) ?>" alt="" height="250px">
                <div class="pull-right">
                  <button type="button" class="btn btn-group-vertical btn-info" data-toggle="modal" data-target="#modalStock" onclick="agregarStock();">Agregar stock</button>
                  <button type="button" class="btn btn-group-vertical btn-danger" data-toggle="modal" data-target="#modalStock" onclick="eliminarStock();">Eliminar stock</button>
                </div>
                <br>
                <br>
                <h4><b>Precio:</b> $<?php echo $data[0][4] ?></h4>
                <h4><b>En stock:</b> <?php echo $data[0][5] ?></h4>
              </div>
            </div>

            <div class="box">
              <!-- /.box-header -->
              <h3 style="padding-left: 12px"><b>Historial de inventario</b></h3>
              <div class="box-body">
                <?php if(!empty($data[1])): ?>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Descripción</th>
                      <th>Referencia</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data[1] as $historial): ?>
                        <tr>
                          <td><?php echo $historial[3]?></td>
                          <td><?php echo $historial[4]?></td>
                          <td><?php echo $historial[5]?></td>
                          <td><?php echo $historial[6]?></td>
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


    <div class="modal fade" id="modalStock">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="tituloModal"></h4>
          </div>
          <form method="POST" action="<?php echo RUTA_URL?>/public/productos/detalles/<?php echo $data[0][0]?>" enctype="multipart/form-data" id="formulario">
          <div class="modal-body">
              <div class="form-group">
                <input type="hidden" class="form-control" name="tipo" id="tipo">
              </div>
              <div class="form-group">
                <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION["id"] ?>">
              </div>
              <div class="form-group">
                <input type="hidden" class="form-control" name="usuario_user" id="usuario_user" value="<?php echo $_SESSION["usuario"] ?>">
              </div>
              <div class="form-group">
                <input type="hidden" class="form-control" name="cant_actual" id="cant_actual" value="<?php echo $data[0][5] ?>">
              </div>
              <div class="form-group">
                <label>Cantidad</label>
                <input type="text" class="form-control" placeholder="Cantidad" name="cantidad" id="cantidad">
              </div>
              <div class="form-group">
                <label>Referencia</label>
                <input type="text" class="form-control" placeholder="Referencia" name="referencia" id="referencia">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" onclick="validar();">Guardar</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


<?php include_once RUTA_APP . "/views/footer.php"; ?>

<script type="text/javascript">
  formulario = document.getElementById("formulario"); //Se obtiene el formulario
  var cantActual = Number(document.getElementById("cant_actual").value); //Se guarda la cantidad actual

  //Función para decirle al formulario que va a agregar stock
  function agregarStock(){
    formulario.tipo.value = "agregar"; //Se asigna el valor de la bandera que controla si se va a agregar o eliminar
    document.getElementById("tituloModal").innerHTML="Agregar stock"; //Se pone el título del modal
  }

  //Función para decirle al formulario que va a eliminar stock
  function eliminarStock(){
    formulario.tipo.value = "eliminar"; //Se asigna el valor de la bandera que controla si se va a agregar o eliminar
    document.getElementById("tituloModal").innerHTML="Eliminar stock"; //Se pone el título del modal
  }

  function validar(){
    event.preventDefault(); //Se aborta el evento submit del formulario
    llenos = 0; //Variable para contar los campos llenados

    //Se comprueba cada campo para ver si se escribió algo
    if(formulario.cantidad.value != 0){
      llenos++;
    }

    if(formulario.referencia.value != 0){
      llenos++;
    }

    var cantidad = Number(formulario.cantidad.value); //Se guarda la cantidad a eliminar

    //Si la cantidad a eliminar es mayor a la cantidad actual
    if(formulario.tipo.value == "eliminar" && (cantidad > cantActual)){
      //...se mostrará una alerta diciéndolo
      swal({
        icon: "warning",
        text: "No puedes eliminar más productos de los que hay actualmente",
        button: "Aceptar"
      });
    }
    else{
      //Si no todos los campos están llenos...
      if(llenos < 2){
        //...se mostrará una alerta diciéndolo
        swal({
          text: "Debes llenar todos los campos",
          button: "Aceptar"
        });
      }else{
        formulario.submit(); //...se ejecuta el evento submit del formulario
      }
    }
  }
</script>
