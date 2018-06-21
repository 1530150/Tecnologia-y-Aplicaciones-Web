<?php
  //Nodelo Alumnas
  class AlumnasModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar una alumna
    public function agregarAlumna($data){
      $this->trans->query("INSERT INTO alumnas VALUES(null, :nombre, :apellido, :fecha_nacimiento, :grupo)");

      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":apellido", $data["apellido"]);
      $this->trans->bind(":fecha_nacimiento", $data["fecha_nacimiento"]);
      $this->trans->bind(":grupo", $data["grupo"]);

      $res = $this->trans->execute();
    }

    //Método para editar una alumna
    public function editarAlumna($data){
      $this->trans->query("UPDATE alumnas SET nombre=:nombre, apellido=:apellido, fecha_nacimiento=:fecha_nacimiento, grupo=:grupo WHERE id=:id");

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":apellido", $data["apellido"]);
      $this->trans->bind(":fecha_nacimiento", $data["fecha_nacimiento"]);
      $this->trans->bind(":grupo", $data["grupo"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar una alumna
    public function eliminarAlumna($id){
      $this->trans->query("DELETE FROM alumnas WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todas las alumnas
    public function getAlumnas(){
      $this->trans->query("SELECT a.id, a.nombre, a.apellido, a.fecha_nacimiento, g.nombre FROM alumnas a INNER JOIN grupos g ON a.grupo=g.id");
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todas las alumnas
    public function getAlumna($id){
      $this->trans->query("SELECT * FROM alumnas WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

    //Método para obtener los grupos
    public function getGrupos(){
      $this->trans->query("SELECT * FROM grupos");
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

  }
?>
