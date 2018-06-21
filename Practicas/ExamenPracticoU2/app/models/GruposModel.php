<?php
  //Nodelo Alumnos
  class GruposModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar un grupo
    public function agregarGrupo($data){
      $this->trans->query("INSERT INTO grupos VALUES(null, :nombre)");

      $this->trans->bind(":nombre", $data["nombre"]);

      $res = $this->trans->execute();
    }

    //Método para editar un grupo
    public function editarGrupo($data){
      $this->trans->query("UPDATE grupos SET nombre=:nombre WHERE id=:id");

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":nombre", $data["nombre"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar un grupo
    public function eliminarGrupo($id){
      $this->trans->query("DELETE FROM grupos WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todas las grupos
    public function getGrupos(){
      $this->trans->query("SELECT * FROM grupos");
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todos los grupos
    public function getGrupo($id){
      $this->trans->query("SELECT * FROM grupos WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

  }
?>
