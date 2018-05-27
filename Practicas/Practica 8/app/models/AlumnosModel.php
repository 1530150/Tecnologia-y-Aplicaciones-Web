<?php
  //Nodelo Alumnos
  class AlumnosModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar un alumno
    public function agregarAlumno($data){
      $this->trans->query("INSERT INTO alumnos VALUES(:matricula, :nombre, :carrera, :tutor)");

      $this->trans->bind(":matricula", $data["matricula"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":carrera", $data["carrera"]);
      $this->trans->bind(":tutor", $data["tutor"]);

      $res = $this->trans->execute();
    }

    //Método para editar un alumno
    public function editarAlumno($data){
      $this->trans->query("UPDATE alumnos SET nombre=:nombre, carrera=:carrera, tutor=:tutor WHERE matricula=:matricula");

      $this->trans->bind(":matricula", $data["matricula"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":carrera", $data["carrera"]);
      $this->trans->bind(":tutor", $data["tutor"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar un alumno
    public function eliminarAlumno($id){
      $this->trans->query("DELETE FROM alumnos WHERE matricula=:matricula");

      $this->trans->bind(":matricula", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todos los alumnos
    public function getAlumnos(){
      $this->trans->query("SELECT a.matricula, a.nombre, c.nombre, p.nombre FROM alumnos a INNER JOIN carreras c ON a.carrera=c.id INNER JOIN profesores p ON a.tutor=p.numEmpleado");
      $res = $this->trans->execute();

      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todos los alumnos
    public function getAlumno($id){
      $this->trans->query("SELECT * FROM alumnos WHERE matricula=:matricula");
      $this->trans->bind(":matricula", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

    //Método para obtener las carreras
    public function getCarreras(){
      $this->trans->query("SELECT * FROM carreras");
      $res = $this->trans->execute();

      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener los profesores
    public function getTutores(){
      $this->trans->query("SELECT * FROM profesores");
      $res = $this->trans->execute();

      $res = $this->trans->execute();

      return $res->fetchAll();
    }


  }
?>
