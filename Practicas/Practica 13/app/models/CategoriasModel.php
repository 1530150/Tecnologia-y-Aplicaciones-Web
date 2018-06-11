<?php
  //Nodelo Productos
  class CategoriasModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar una categoría
    public function agregarCategoria($data){
      $this->trans->query("INSERT INTO categorias VALUES(null, :nombre, :descripcion, :fecha, :tienda)");

      $fecha = date("Y-m-d");

      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":descripcion", $data["descripcion"]);
      $this->trans->bind(":fecha", $fecha);
      $this->trans->bind(":tienda", $data["tienda"]);

      $res = $this->trans->execute();
    }

    //Método para editar una categoria
    public function editarCategoria($data){
      $this->trans->query("UPDATE categorias SET nombre=:nombre, descripcion=:descripcion WHERE id=:id");

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":descripcion", $data["descripcion"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar una categoria
    public function eliminarCategoria($id){
      $this->trans->query("DELETE FROM categorias WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todas las categorías
    public function getCategorias($tienda){
      $this->trans->query("SELECT * FROM categorias WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener una categoría en específico
    public function getCategoria($id){
      $this->trans->query("SELECT * FROM categorias WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

  }
?>
