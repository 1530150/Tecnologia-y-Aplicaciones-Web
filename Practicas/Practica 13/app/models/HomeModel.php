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
        //Se valida que la tienda esté activada
        if($this->getEstadoTienda($usuario["tienda"]) == 1){
          //Si se cumple todo, se crea la sesión
          session_start();
          $_SESSION["nombre"] = $usuario["nombre"] . " " . $usuario["apellido"];
          $_SESSION["usuario"] = $usuario["nombre_usuario"];
          $_SESSION["password"] = $usuario["password"];
          $_SESSION["correo"] = $usuario["correo"];
          $_SESSION["imagen"] = $usuario["ruta_img"];
          $_SESSION["id"] = $usuario["id"];
          $_SESSION["tienda"] = $usuario["tienda"];

          return true; //Se devuelve true
        }
      }

      return false; //Si no se cumple nada se devuelve false
    }

    //Método pra obtener la información que se mostrará en el dashboard
    public function getTotales($tienda){
      //Número de tiendas
      $this->trans->query("SELECT COUNT(id) FROM tiendas WHERE id!=1"); //Se omite el id 1 porque es el del admin
      $res = $this->trans->execute();
      $tiendas = $res->fetchColumn();

      //Número de usuarios
      $this->trans->query("SELECT COUNT(id) FROM usuarios WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();
      $usuarios = $res->fetchColumn();

      //Número de productos
      $this->trans->query("SELECT COUNT(id) FROM productos WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();
      $productos = $res->fetchColumn();

      //Número de categorías
      $this->trans->query("SELECT COUNT(id) FROM categorias WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();
      $categorias = $res->fetchColumn();

      //Número de ventas
      $this->trans->query("SELECT COUNT(id) FROM ventas WHERE tienda=:tienda");
      $this->trans->bind(":tienda", $tienda);
      $res = $this->trans->execute();
      $ventas = $res->fetchColumn();

      //Se retorna la lista de totales
      return array($tiendas, $usuarios, $productos, $categorias, $ventas);
    }

    //Método para obtener la tienda en la que está registrada el usuario
    public function getTiendaUsuario($id){
      $this->trans->query("SELECT tienda FROM usuarios WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetchColumn();
    }

    //Método para obtener el nombre de la tienda
    public function getNombreTienda($id){
      $this->trans->query("SELECT nombre FROM tiendas WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetchColumn();
    }

    //Método para obtener el estado de una tienda, si está activada o desactivada
    public function getEstadoTienda($id){
      $this->trans->query("SELECT activada FROM tiendas WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetchColumn();
    }

  }
?>
