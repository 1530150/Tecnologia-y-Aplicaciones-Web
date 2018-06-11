<?php
  //Nodelo Productos
  class VentasModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar una venta
    public function agregarVenta($data){
      $this->trans->query("INSERT INTO ventas VALUES(null, :fecha, :total, :tienda)");

      $fecha = date("Y-m-d"); //Se obtiene la fecha

      //Se agrega la venta
      $this->trans->bind(":fecha", $fecha);
      $this->trans->bind(":total", $data["total"]);
      $this->trans->bind(":tienda", $data["tienda"]);
      $res = $this->trans->execute();

      //Se obtiene el id de la venta recien agregada
      $this->trans->query("SELECT id FROM ventas ORDER BY id DESC LIMIT 1");
      $res = $this->trans->execute();
      $venta = $res->fetchColumn();

      //Se van insertando los productos y la cantidad a la tabla de producto_venta
      for($i=0; $i<sizeof($data["productos"]); $i++){
        $this->trans->query("INSERT INTO venta_productos VALUES(:venta, :producto, :cantidad)");
        $this->trans->bind(":venta", $venta);
        $this->trans->bind(":producto", $data["productos"][$i]);
        $this->trans->bind(":cantidad", $data["cantidades"][$i]);
        $this->trans->execute();
      }
    }





    //Método para eliminar una venta
    public function eliminarVenta($id){
      //Primero se eliminan los datos de la tabla venta_productos
      $this->trans->query("DELETE FROM venta_productos WHERE venta=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      //Posteriormente se elimina la venta en sí
      $this->trans->query("DELETE FROM ventas WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();
    }

    //Método para obtener todas las ventas
    public function getVentas($tienda){
      $this->trans->query("SELECT * FROM ventas WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todas las ventas
    public function getDetallesVenta($venta){
      $this->trans->query("SELECT p.nombre, vp.cantidad FROM venta_productos vp INNER JOIN productos p ON vp.producto=p.id WHERE venta=:venta");
      $this->trans->bind(":venta", $venta);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener una venta en específico
    public function getVenta($id){
      $this->trans->query("SELECT * FROM ventas WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

    //Método para obtener los productos
    public function getProductos($tienda){
      $this->trans->query("SELECT * FROM productos WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

  }
?>
