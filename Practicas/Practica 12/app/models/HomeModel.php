<?php
  //Nodelo Alumnos
  class HomeModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para iniciar sesión
    public function validarLogin($data){
      $this->trans->query("SELECT * FROM usuarios WHERE nombre_usuario=:usuario AND password=:clave"); //Consulta
      $data["clave"] = md5($data["clave"]);

      //Preparación y ejecución de la consulta
      $this->trans->bind(":usuario", $data["usuario"]);
      $this->trans->bind(":clave", $data["clave"]);
      $res = $this->trans->execute();

      //Se crea la sesión y se guarda la info del usuario
      if($usuario = $res->fetch(PDO::FETCH_ASSOC)){
          session_start();
          $_SESSION["nombre"] = $usuario["nombre"] . " " . $usuario["apellido"];
          $_SESSION["usuario"] = $usuario["nombre_usuario"];
          $_SESSION["password"] = $usuario["password"];
          $_SESSION["correo"] = $usuario["correo"];
          $_SESSION["imagen"] = $usuario["ruta_img"];
          $_SESSION["id"] = $usuario["id"];

          return true;
      }
      else{
        return false;
      }
    }

    //Método para verificar si hay una sesión iniciada
    public function sesionIniciada(){
        session_start();
        return isset($_SESSION["usuario"]);
    }

    //Método para verificar si el usuario es un administrador
    public function esAdmin(){
      return $_SESSION["nivel"] == "Administrador";
    }

    //Método pra obtener la información que se mostrará en el dashboard
    public function getTotales(){
      //Número de usuarios
      $this->trans->query("SELECT COUNT(id) FROM usuarios");
      $res = $this->trans->execute();
      $usuarios = $res->fetchColumn();

      //Número de productos
      $this->trans->query("SELECT COUNT(id) FROM productos");
      $res = $this->trans->execute();
      $productos = $res->fetchColumn();

      //Número de categorías
      $this->trans->query("SELECT COUNT(id) FROM categorias");
      $res = $this->trans->execute();
      $categorias = $res->fetchColumn();

      return array($usuarios, $productos, $categorias);
    }

  }
?>
