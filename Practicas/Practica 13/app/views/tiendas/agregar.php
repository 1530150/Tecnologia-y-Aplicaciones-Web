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
        Agregar tienda
        <small>Tiendas</small>
      </h1>
    </section>


<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-6" style="margin-left: 250px">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="formulario" action="<?php echo RUTA_URL?>/public/tiendas/agregar" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" onclick="validar();">Aceptar</button>
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

<?php include_once RUTA_APP . "/views/footer.php"; ?>

<script type="text/javascript">
  formulario = document.getElementById("formulario"); //Se obtiene el formulario

  function validar(){
    event.preventDefault(); //Se aborta el evento submit del formulario
    llenos = 0; //Variable para contar los campos llenados

    //Se comprueba cada campo para ver si se escribió algo
    if(formulario.nombre.value != 0){
      llenos++;
    }

    if(formulario.descripcion.value != 0){
      llenos++;
    }

    //Si no todos los campos están llenos...
    if(llenos < 2){
      //...se mostrará una alerta diciéndolo
      swal({
        text: "Debes llenar todos los campos",
        button: "Aceptar"
      });
    }else{
      eventoAlert(); //Si todos los campos están llenos se ejecuta la función para mostrar la alerta de "success"
    }
  }

  //Función para mostrar la alerta
  function eventoAlert(){
    //Se crea la alerta
    swal({
      title: "Tienda agregada correctamente",
      icon: "success",
      button: "Aceptar",
    })
    //Si se dio clic en aceptar en la alerta...
    .then((value) => {
      formulario.submit(); //...se ejecuta el evento submit del formulario
    })
  }
</script>
