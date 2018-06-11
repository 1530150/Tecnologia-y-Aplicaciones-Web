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
        Agregar producto
        <small>Productos</small>
      </h1>
    </section>


<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-6" style="margin-left: 250px">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="formulario" action="<?php echo RUTA_URL?>/public/productos/agregar" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="codigo">Código</label>
                  <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="precio">Precio</label>
                  <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio">
                </div>
                <div class="form-group">
                  <label for="cantidad">Cantidad</label>
                  <input type="text" class="form-control" name="stock" id="stock" placeholder="Cantidad">
                </div>
                <div class="form-group">
                  <label>Categoría</label>
                  <select class="form-control select2" style="width: 100%;" name="categoria" id="categoria">
                    <?php foreach($data as $categoria): ?>
                      <option value="<?php echo $categoria[0]?>"><?php echo $categoria[1]?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="cantidad">Imagen</label>
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

<?php include_once RUTA_APP . "/views/footer.php"; ?>

<script type="text/javascript">
  formulario = document.getElementById("formulario"); //Se obtiene el formulario

  function validar(){
    event.preventDefault(); //Se aborta el evento submit del formulario
    llenos = 0; //Variable para contar los campos llenados

    //Se comprueba cada campo para ver si se escribió algo
    if(formulario.codigo.value != 0){
      llenos++;
    }

    if(formulario.nombre.value != 0){
      llenos++;
    }

    if(formulario.precio.value != 0){
      llenos++;
    }

    if(formulario.stock.value != 0){
      llenos++;
    }

    if(formulario.categoria.value != 0){
      llenos++;
    }

    if(formulario.imagen.value != 0){
      llenos++;
    }

    //Si no todos los campos están llenos...
    if(llenos < 6){
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
      title: "Producto agregado correctamente",
      icon: "success",
      button: "Aceptar",
    })
    //Si se dio clic en aceptar en la alerta...
    .then((value) => {
      formulario.submit(); //...se ejecuta el evento submit del formulario
    })
  }
</script>
