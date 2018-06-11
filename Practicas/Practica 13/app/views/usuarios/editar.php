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
        Agregar usuario
        <small>Usuarios</small>
      </h1>
    </section>


<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-6" style="margin-left: 250px">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="formulario" action="<?php echo RUTA_URL?>/public/usuarios/editar" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $data[0] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $data[1] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Apellido</label>
                  <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="<?php echo $data[2] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contraseña</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" value="<?php echo $data[4] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Correo electrónico</label>
                  <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $data[5] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="imagen">Imagen</label>
                <div class="">
                  <img src="<?php echo RUTA_URL . substr($data[7], 58) ?>" class="img-circle" width="50px" height="50px">
                  <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Cantidad">
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

    <!-- Input para almacenar la contraseña -->
    <input type="hidden" id="clave" value="<?php echo $_SESSION["password"] ?>">


    <?php include_once RUTA_APP . "/views/footer.php"; ?>

    <script type="text/javascript">
      formulario = document.getElementById("formulario"); //Se obtiene el formulario
      var clave = document.getElementById("clave").value; //Se obtiene la contraseña desde el input

      function validar(){
        event.preventDefault(); //Se aborta el evento submit del formulario
        llenos = 0; //Variable para contar los campos llenados

        //Se comprueba cada campo para ver si se escribió algo
        if(formulario.nombre.value != 0){
          llenos++;
        }

        if(formulario.apellido.value != 0){
          llenos++;
        }


        if(formulario.password.value != 0){
          llenos++;
        }

        if(formulario.correo.value != 0){
          llenos++;
        }

        //Si no todos los campos están llenos...
        if(llenos < 4){
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
            formulario.submit();
          }
          else{
            swal("La contraseña es incorrecta");
          }
        })
      }
    </script>

<?php include_once RUTA_APP . "/views/footer.php"; ?>
