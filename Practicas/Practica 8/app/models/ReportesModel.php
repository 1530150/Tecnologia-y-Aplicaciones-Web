<?php
  //Nodelo Tutoerias
  class ReportesModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para obtener todas las tutorías del profesor
    public function getTutorias($id){
      $this->trans->query("SELECT (SELECT GROUP_CONCAT(a.nombre SEPARATOR ', ') FROM alumnos a INNER JOIN alumnos_tutoria at ON a.matricula=at.alumno INNER JOIN tutorias t1 ON at.tutoria=t1.id WHERE at.tutoria=t.id) alumnos, p.nombre, t.fecha, t.hora, t.tipo_tutoria, t.descripcion FROM tutorias t INNER JOIN alumnos_tutoria at2 ON t.id=at2.tutoria INNER JOIN profesores p ON p.numEmpleado=t.tutor WHERE t.tutor=:id GROUP BY t.id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener los alumnos del profesor
    public function getAlumnos($tutor){
      $this->trans->query("SELECT a.matricula, a.nombre, c.nombre, p.nombre FROM alumnos a INNER JOIN carreras c ON a.carrera=c.id INNER JOIN profesores p ON a.tutor=p.numEmpleado WHERE a.tutor=:tutor");
      $this->trans->bind(":tutor", $tutor);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

  }
?>
