<?php
  //Nodelo Productos
  class ProductosModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar un producto
    public function agregarProducto($data){
      $this->trans->query("INSERT INTO productos VALUES(null, :codigo, :nombre, :fecha, :precio, :stock, :categoria, :destino, :tienda)");

      $fecha = date("Y-m-d"); //Se obtiene la fecha actual
      $destino_img = substr(RUTA_APP, 0, -4) . "/public/dist/img/" . $data["nombre_img"]; //Se crea el destino de la imagen
      copy($data["ruta_img"], $destino_img); //Se copia la imagen al servidor

      $this->trans->bind(":codigo", $data["codigo"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":fecha", $fecha);
      $this->trans->bind(":precio", $data["precio"]);
      $this->trans->bind(":stock", $data["stock"]);
      $this->trans->bind(":categoria", $data["categoria"]);
      $this->trans->bind(":destino", $destino_img);
      $this->trans->bind(":tienda", $data["tienda"]);


      $res = $this->trans->execute();
    }

    //Método para editar un producto
    public function editarProducto($data){
      //Se comprueba que se haya agregado una nueva imagen al producto
      if(isset($data["nombreimg"])){
        $destino_img = substr(RUTA_APP, 0, -4) . "/public/dist/img/" . $data["nombre_img"]; //Se crea el destino de la imagen
        copy($data["ruta_img"], $destino_img); //Se copia la imagen al servidor
        $this->trans->query("UPDATE productos SET codigo=:codigo, nombre=:nombre, precio=:precio, stock=:stock, categoria=:categoria, ruta_img=:destino WHERE id=:id");
        $this->trans->bind(":destino", $destino_img);
      }
      else{
        $this->trans->query("UPDATE productos SET codigo=:codigo, nombre=:nombre, precio=:precio, stock=:stock, categoria=:categoria WHERE id=:id");
      }

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":codigo", $data["codigo"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":precio", $data["precio"]);
      $this->trans->bind(":stock", $data["stock"]);
      $this->trans->bind(":categoria", $data["categoria"]);

      $res = $this->trans->execute();
    }

    //Método para agregar o eliminar stock de un producto
    public function modificarStock($data){
      $this->trans->query("UPDATE productos SET stock=:stock WHERE id=:id"); //Se prepara la consulta para modificar el producto
      $nuevaCantidad = $data["cantidad_actual"]; //Se guarda la cantidad actual de stock

      //Se comprueba la acción a hacer, agregar o eliminar
      if($data["tipo"] == "agregar"){
        $nuevaCantidad += $data["cantidad"]; //Si es agregar, se aumenta el stock
        $nota = $data["usuario_user"] . " agregó " . $data["cantidad"] . " producto(s) al inventario"; //Nota del historial
      }
      else{
        $nuevaCantidad -= $data["cantidad"]; //Si es eliminar, se reduce el stock
        $nota = $data["usuario_user"] . " eliminó " . $data["cantidad"] . " producto(s) del inventario"; //Nota del historial
      }

      $this->trans->bind(":stock", $nuevaCantidad); //Se reemplazan los datos
      $this->trans->bind(":id", $data["id"]); //Se reemplazan los datos
      $res = $this->trans->execute(); //Se ejecuta la consulta


      //Se prepara la consulta para agregar el historial
      $this->trans->query("INSERT INTO historiales VALUES(null, :producto, :usuario, :fecha, :nota, :referencia, :cantidad, :tienda)");

      $fecha = date("Y-m-d"); //Se obtiene la fecha actual

      //Se reemplazan los datos
      $this->trans->bind(":producto", $data["id"]);
      $this->trans->bind(":usuario", $data["usuario"]);
      $this->trans->bind(":fecha", $fecha);
      $this->trans->bind(":nota", $nota);
      $this->trans->bind(":referencia", $data["referencia"]);
      $this->trans->bind(":cantidad", $data["cantidad"]);
      $this->trans->bind(":tienda", $data["tienda"]);

      $res = $this->trans->execute(); //Se ejecuta la consulta

    }



    //Método para eliminar un producto
    public function eliminarProducto($id){
      $this->trans->query("DELETE FROM productos WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todos los productos
    public function getProductos($tienda){
      $this->trans->query("SELECT p.id, p.codigo, p.nombre, p.fecha_agregado, p.precio, p.stock, c.nombre, p.ruta_img FROM productos p INNER JOIN categorias c ON p.categoria=c.id WHERE p.tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener un producto en específico
    public function getProducto($id){
      $this->trans->query("SELECT * FROM productos WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

    //Método para obtener las categorías
    public function getCategorias($tienda){
      $this->trans->query("SELECT * FROM categorias WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener el historial de modificaciones del producto
    public function getHistorial($id){
      $this->trans->query("SELECT h.id, p.nombre, u.nombre, h.fecha, h.nota, h.referencia, h.cantidad FROM historiales h INNER JOIN productos p ON h.producto=p.id INNER JOIN usuarios u ON h.usuario=u.id WHERE h.producto=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener los productos con un stock menor a 5
    public function getNotificacionesProductos($tienda){
      $this->trans->query("SELECT * FROM productos WHERE stock <= 5 AND tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);

      $res = $this->trans->execute();

      return $res->fetchAll();
    }
  }
?>
