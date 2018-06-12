<?php
  //Nodelo Productos
  class TiendasModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar una tienda
    public function agregarTienda($data){
      $this->trans->query("INSERT INTO tiendas VALUES(null, :nombre, :descripcion)");

      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":descripcion", $data["descripcion"]);

      $res = $this->trans->execute();
    }

    //Método para editar una tienda
    public function editarTienda($data){
      $this->trans->query("UPDATE tiendas SET nombre=:nombre, descripcion=:descripcion WHERE id=:id");

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":descripcion", $data["descripcion"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar una tienda
    public function eliminarTienda($id){
      $this->trans->query("DELETE FROM tiendas WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }

    //Método para activar o desactivar una tienda
    public function activarTienda($id){
      $estado = $this->getEstadoTienda($id); //Se obtiene el estado actual de la tienda

      //Se cambia el estado de la tienda
      if($estado == 1){
        $estado = 0;
      }
      else{
        $estado = 1;
      }

      //Se ejecuta la consulta
      $this->trans->query("UPDATE tiendas SET activada=:activar WHERE id=:id");
      $this->trans->bind(":activar", $estado);
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();
    }

    //Método para obtener todas las categorías
    public function getTiendas(){
      $this->trans->query("SELECT * FROM tiendas WHERE id!=1");
      $res = $this->trans->execute();

      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener una categoría en específico
    public function getTienda($id){
      $this->trans->query("SELECT * FROM tiendas WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

    //Método para obtener el estado de una tienda, si está activada o desactivada
    public function getEstadoTienda($id){
      $this->trans->query("SELECT activada FROM tiendas WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetchColumn();
    }

  }
?>
