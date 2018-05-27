<?php
  //Nodelo Tutoerias
  class TutoriasModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar una tutoria
    public function agregarTutoria($data){
      //Se agrega la tutoría a la tabla de tutorías
      $this->trans->query("INSERT INTO tutorias VALUES(null, :tutor, :fecha, :hora, :tipo, :descripcion)");
      $this->trans->bind(":tutor", $data["tutor"]);
      $this->trans->bind(":fecha", $data["fecha"]);
      $this->trans->bind(":hora", $data["hora"]);
      $this->trans->bind(":tipo", $data["tipo"]);
      $this->trans->bind(":descripcion", $data["descripcion"]);
      $res = $this->trans->execute();

      //Se obtiene el id de la tutoría recien agregada
      $this->trans->query("SELECT id FROM tutorias ORDER BY id DESC LIMIT 1");
      $res = $this->trans->execute();
      $tutoria = $res->fetchColumn();


      //Se van insertando los alumnos y la tutoría a la tabla de alumnos_tutoria
      foreach($data["alumnos"] as $alumno){
        $this->trans->query("INSERT INTO alumnos_tutoria VALUES(:alumno, :tutoria)");
        $this->trans->bind(":alumno", $alumno);
        $this->trans->bind(":tutoria", $tutoria);
        $this->trans->execute();
      }


    }

    /*
    //Método para editar una tutoria
    public function editarTutoria($data){
      $this->trans->query("UPDATE tutorias SET alumno=:alumno, tutor=:tutor, fecha=:fecha, hora=:hora, tipo_tutoria=:tipo, descripcion=:descripcion WHERE id=:id");

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":alumno", $data["alumno"]);
      $this->trans->bind(":tutor", $data["tutor"]);
      $this->trans->bind(":fecha", $data["fecha"]);
      $this->trans->bind(":hora", $data["hora"]);
      $this->trans->bind(":tipo", $data["tipo"]);
      $this->trans->bind(":descripcion", $data["descripcion"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar una tutoria
    public function eliminarTutoria($id){
      $this->trans->query("DELETE FROM tutorias WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }
    */

    //Método para obtener todas las tutorías
    public function getTutorias(){
      $this->trans->query("SELECT (SELECT GROUP_CONCAT(a.nombre SEPARATOR ', ') FROM alumnos a INNER JOIN alumnos_tutoria at ON a.matricula=at.alumno INNER JOIN tutorias t1 ON at.tutoria=t1.id WHERE at.tutoria=t.id) alumnos, p.nombre, t.fecha, t.hora, t.tipo_tutoria, t.descripcion FROM tutorias t INNER JOIN alumnos_tutoria at2 ON t.id=at2.tutoria INNER JOIN profesores p ON p.numEmpleado=t.tutor GROUP BY t.id");
      $res = $this->trans->execute();

      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todos los alumnos
    public function getTutoria($id){
      $this->trans->query("SELECT * FROM tutorias WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }

    //Método para obtener los alumnos de un profesor en específico
    public function getAlumnos($tutor){
      $this->trans->query("SELECT * FROM alumnos WHERE tutor=:tutor");
      $this->trans->bind(":tutor", $tutor);

      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todos los profesores
    public function getTutores($id){
      $this->trans->query("SELECT * FROM profesores WHERE numEmpleado=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }


  }
?>
