<?php
  //Nodelo Alumnos
  class ProfesoresModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar un alumno
    public function agregarProfesor($data){
      $this->trans->query("INSERT INTO profesores VALUES(null, :nombre, :tipo, :email, :password, :carrera)");

      $data["password"] = md5($data["password"]); //Se encripta la contraseña

      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":email", $data["email"]);
      $this->trans->bind(":tipo", $data["tipo"]);
      $this->trans->bind(":password", $data["password"]);
      $this->trans->bind(":carrera", $data["carrera"]);

      $res = $this->trans->execute();
    }

    //Método para editar un alumno
    public function editarProfesor($data){
      $this->trans->query("UPDATE profesores SET nombre=:nombre, email=:email, nivel=:tipo, password=:password, carrera=:carrera WHERE numEmpleado=:numEmpleado");

      $data["password"] = md5($data["password"]); //Se encripta la contraseña

      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":email", $data["email"]);
      $this->trans->bind(":tipo", $data["tipo"]);
      $this->trans->bind(":password", $data["password"]);
      $this->trans->bind(":carrera", $data["carrera"]);
      $this->trans->bind(":numEmpleado", $data["numEmp"]);

      $res = $this->trans->execute();
    }

    //Método para eliminar un alumno
    public function eliminarProfesor($id){
      $this->trans->query("DELETE FROM profesores WHERE numEmpleado=:numEmpleado");

      $this->trans->bind(":numEmpleado", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todos los alumnos
    public function getProfesores(){
      $this->trans->query("SELECT p.numEmpleado, p.nombre, p.nivel, p.email, c.nombre FROM profesores p INNER JOIN carreras c ON p.carrera=c.id");
      $res = $this->trans->execute();

      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todos los alumnos
    public function getProfesor($id){
      $this->trans->query("SELECT * FROM profesores WHERE numEmpleado=:numEmpleado");
      $this->trans->bind(":numEmpleado", $id);
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


  }
?>
