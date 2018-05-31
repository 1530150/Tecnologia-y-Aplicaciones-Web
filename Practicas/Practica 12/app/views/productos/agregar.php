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
        <div class="col-xs-6">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Código</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Código">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Precio</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Precio">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Cantidad</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Cantidad">
                </div>
                <div class="form-group">
                  <label>Categoría</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option>Categoría 1</option>
                    <option>Categoría 2</option>
                    <option>Categoría 3</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Aceptar</button>
              </div>
            </form>
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
