<?php
  //Nodelo Alumnos
  class CarrerasModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar un alumno
    public function agregarCarrera($data){
      $this->trans->query("INSERT INTO carreras VALUES(null, :nombre)");

      $this->trans->bind(":nombre", $data["nombre"]);

      $res = $this->trans->execute();
    }

    //Método para editar un alumno
    public function editarCarrera($data){
      $this->trans->query("UPDATE carreras SET nombre=:nombre WHERE id=:id");

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":nombre", $data["nombre"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar un alumno
    public function eliminarCarrera($id){
      $this->trans->query("DELETE FROM carreras WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todas las carreras
    public function getCarreras(){
      $this->trans->query("SELECT * FROM carreras");
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todos los alumnos
    public function getCarrera($id){
      $this->trans->query("SELECT * FROM carreras WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

  }
?>
