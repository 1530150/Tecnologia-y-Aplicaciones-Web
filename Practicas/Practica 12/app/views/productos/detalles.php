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
        Detalles del producto
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>


<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="pull-right">
                <button type="button" class="btn btn-group-vertical btn-info">Agregar stock</button>
                <button type="button" class="btn btn-group-vertical btn-danger">Eliminar stock</button>
              </div>
              <h1>Producto 1</h1>
              <div class="col-xs-3" style="padding: 100px; border-style: solid; border-width: 1px;">

              </div>
                <div style="padding: 100px;">

                </div>
                <br>
                <h4><b>Precio:</b> $250</h4>
                <h4><b>En stock:</b> 15</h4>
              </div>
            </div>

            <div class="box">
              <!-- /.box-header -->
              <h3 style="padding-left: 12px"><b>Historial de inventario</b></h3>
              <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Descripción</th>
                  <th>Referencia</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>12/Mayo/2018</td>
                  <td>12:04</td>
                  <td>Usuario agregó 1 producto</td>
                  <td>123</td>
                  <td>1</td>
                </tr>
                <tr>
                  <td>16/Mayo/2018</td>
                  <td>14:16</td>
                  <td>Usuario eliminó 4 producto</td>
                  <td>942</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>24/Mayo/2018</td>
                  <td>17:32</td>
                  <td>Usuario agregó 5 productos</td>
                  <td>493</td>
                  <td>5</td>
                </tr>
                </tbody>
              </table>
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


<script type="text/javascript">
  var botones = document.getElementsByName("eliminar"); //Array con todos los botones de eliminar

  //Para cada botón del array
  for(var i=0; i<botones.length; i++){
    (function (boton){
      //Si se da clic al botón
      boton.onclick = function (){
        //Se crea la alerta
        swal({
          title: "¿Estás seguro que deseas eliminar a este alumno?",
          icon: "warning",
          buttons: ["Cancelar", "Aceptar"],
        })
        //Si se dio clic en aceptar en la alerta...
        .then((value) => {
          //Se comprueba que se haya dado clic en aceptar dado el valor de "value"
          if(value){
            window.location.href="<?php echo RUTA_URL ?>/public/alumnos/eliminarAlumno/"+boton.value; //...se redirecciona para eliminar al alumno
          }
        })
      };
    })(botones[i]); //Se pasa como argumento el botón en la posición i
  }
</script>

<?php include_once RUTA_APP . "/views/footer.php"; ?>
