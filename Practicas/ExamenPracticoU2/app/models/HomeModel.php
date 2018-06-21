<?php
  //Nodelo Alumnos
  class HomeModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para iniciar sesión
    function validarLogin($data){
      $this->trans->query("SELECT * FROM profesores WHERE email=:email AND password=:clave"); //Consulta
      $data["clave"] = md5($data["clave"]);

      //Preparación y ejecución de la consulta
      $this->trans->bind(":email", $data["nombre"]);
      $this->trans->bind(":clave", $data["clave"]);
      $res = $this->trans->execute();

      //Se crea la sesión y se guarda la info del usuario
      if($usuario = $res->fetch(PDO::FETCH_ASSOC)){
          session_start();
          $_SESSION["id"] = $usuario["numEmpleado"];
          $_SESSION["usuario"] = $usuario["nombre"];
          $_SESSION["nivel"] = $usuario["nivel"];

          return true;
      }
      else{
        return false;
      }
    }

    //Método para verificar si hay una sesión iniciada
    function sesionIniciada(){
        session_start();
        return isset($_SESSION["usuario"]);
    }

    //Método para verificar si el usuario es un administrador
    function esAdmin(){
      //return $_SESSION["nivel"] == "Administrador";
    }

  }
?>
