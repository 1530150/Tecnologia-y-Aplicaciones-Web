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
        Agregar venta
        <small>Ventas</small>
      </h1>
    </section>


<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-9" style="margin-left: 135px">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <!--  <form role="form" id="formulario" action="<?php echo RUTA_URL?>/public/ventas/agregar" method="post"> -->
              <div class="box-body">
                <div class="form-group">
                  <label>Productos</label>
                  <select class="form-control" style="width: 100%;" name="lista_productos" id="lista_productos">
                    <?php foreach($data as $producto): ?>
                      <!-- El option guardará como valor el id, nombre y precio del producto -->
                      <option value="<?php echo $producto[0] . ',' . $producto[2] . ',' . $producto[4]?>"><?php echo $producto[2]?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn bg-maroon" onclick="agregarProducto();">Agregar producto</button>
              </div>
            <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_productos" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Precio</th>
                      <th>Cantidad</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                <p class="pull-right">
                  <b>Total:</b>
                  <a id="total" style="color: #000"></a>
                </p>
            </div>

            <!-- Formulario oculto -->
            <form role="form" id="formulario" action="<?php echo RUTA_URL?>/public/ventas/agregar" method="post">

              <div class="box-footer" id="btnEnviar">

              </div>
            </form>
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
  var total = 0; //Total de la venta
  var productos = []; //Array de productos

  function agregarProducto(){
    var select = document.getElementById("lista_productos"); //Se obtiene el select de productos
    var producto = (select.value).split(","); //Se guarda el producto seleccionado en un array

    if(!productoExiste(producto[0])){
      productos[productos.length] = [producto[0], producto[1], producto[2], 1]; //Se agrega el producto al array de productos
    }

    dibujarTabla(); //Se dibuja la tabla
  }

  //Función para dibujar la tabla de productos
  function dibujarTabla(){
    //Se obtiene la tabla
    var tabla=document.getElementById("tabla_productos").getElementsByTagName("tbody")[0];

    //Se elimnan las tablas actuales
    while(tabla.rows.length > 0) {
      tabla.deleteRow(0);
    }

    total = 0; //Se reinicia el total

    for(var i=0; i<productos.length; i++){
      var fila=tabla.insertRow(tabla.rows.length);

      //Se insertan columnas a la fila
      var col1=fila.insertCell(0);
      var col2=fila.insertCell(1);
      var col3=fila.insertCell(2);
      var col4=fila.insertCell(3);

      //Se le asigna información a las columnas
      col1.innerHTML=productos[i][1];
      col2.innerHTML=productos[i][2];
      col3.innerHTML=productos[i][3];
      col4.innerHTML="<button ' class='btn btn-group-vertical btn-danger' value='" + productos[i][0] + "' onclick='quitarLista(this.value)'>Eliminar</button>";

      total += (productos[i][2] * productos[i][3]); //Se acumula el total
    }

    document.getElementById("total").innerHTML = "$" + total; //Se muestra el total en la interfaz

    //Se muestra el botón para enviar siempre y cuando haya productos en la venta
    if(productos.length > 0){
      document.getElementById("btnEnviar").innerHTML = "<button type='submit' class='btn btn-primary pull-right' onclick='enviar()'>Terminar venta</button>";
    }
    else{
      document.getElementById("btnEnviar").innerHTML = "";
    }
  }

  //Función para verificar si un producto ya está en el array de productos
  function productoExiste(id){
    //Se recorre el array de productos
    for(var i=0; i<productos.length; i++){
      //Si se encuentra el producto
      if(productos[i][0] == id){
        productos[i][3]++; //Se aumenta la cantidad

        return true; //Se devuelve true
      }
    }

    return false; //si no se encuentra devuelve false
  }

  //Función para quitar un producto de la lista de venta
  function quitarLista(id){
    //Se recorre el array de productos
    for(var i=0; i<productos.length; i++){
      //Si se encuentra el producto
      if(productos[i][0] == id){
        productos.splice(i, 1); //Se elimina el producto

        break;
      }
    }

    dibujarTabla(); //Se redibuja la tabla
  }

  //Función para terminar y guardar la venta
  function enviar(){
    event.preventDefault(); //Se aborta el evento submit del formulario

    formulario = document.getElementById("formulario"); //Se obtiene el formulario

    //Se recorre el array de productos
    for(var i=0; i<productos.length; i++){
      //Se crea un nuevo input tipo hidden en el que se agregará el producto en la posición i
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "productos[]";
      input.value = productos[i][0];
      formulario.appendChild(input);

      //Se crea un nuevo input tipo hidden en el que se agregará la cantidad del producto en la posición i
      var input2 = document.createElement("input");
      input2.type = "hidden";
      input2.name = "cantidades[]";
      input2.value = productos[i][3];
      formulario.appendChild(input2);
    }

    //Se crea un nuevo input tipo hidden en el que se agregará el total de la venta
    var input3 = document.createElement("input");
    input3.type = "hidden";
    input3.name = "total";
    input3.value = total;
    formulario.appendChild(input3);


    formulario.submit(); //se ejecuta el evento submit del formulario
  }

</script>
