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
        Clientes
        <small>Inicio</small>
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
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha de nacimiento</th>
                  <th>Dirección</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Nombre 1</td>
                  <td>31-12-1990</td>
                  <td>Dirección 1</td>
                  <td>Correo 1</td>
                  <td>Teléfono 1</td>
                  <td>
                    <button type="button" class="btn btn-group-vertical btn-primary">Modificar</button>
                    <button type="button" class="btn btn-group-vertical btn-danger">Eliminar</button>
                  </td>
                </tr>
                <tr>
                  <td>Nombre 2</td>
                  <td>31-12-1990</td>
                  <td>Dirección 2</td>
                  <td>Correo 2</td>
                  <td>Teléfono 2</td>
                  <td>
                    <button type="button" class="btn btn-group-vertical btn-primary">Modificar</button>
                    <button type="button" class="btn btn-group-vertical btn-danger">Eliminar</button>
                  </td>
                </tr>
                <tr>
                  <td>Nombre 3</td>
                  <td>31-12-1990</td>
                  <td>Dirección 3</td>
                  <td>Correo 3</td>
                  <td>Teléfono 3</td>
                  <td>
                    <button type="button" class="btn btn-group-vertical btn-primary">Modificar</button>
                    <button type="button" class="btn btn-group-vertical btn-danger">Eliminar</button>
                  </td>
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
