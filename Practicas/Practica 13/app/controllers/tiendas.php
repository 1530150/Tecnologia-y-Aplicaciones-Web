<?php
  //Controlador de usuarios
  class Tiendas extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("TiendasModel");
      session_start(); //Para poder acceder a la variable $_SESSION
    }

    //Página index
    public function index(){
      $tiendas = $this->modelo->getTiendas();

      $this->view("tiendas/index", $tiendas);
    }

    //Página para agregar una tienda
    public function agregar(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["nombre"]),
          "descripcion" => trim($_POST["descripcion"])
        ];

        $this->modelo->agregarTienda($datos); //Se agrega la tienda

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("tiendas/agregar");
      }
    }

    //Página para editar una tienda
    public function editar($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "nombre" => trim($_POST["nombre"]),
          "descripcion" => trim($_POST["descripcion"])
        ];

        $this->modelo->editarTienda($datos); //Se edita la tienda

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("tiendas/editar", $this->modelo->getTienda($id));
      }
    }

    //Método para eliminar una tienda
    public function eliminar($id = ""){

      $this->modelo->eliminarTienda($id); //Se elimina la tienda

      $this->index(); //Se regresa al index
    }

    //Página para editar una tienda
    public function entrar($id = ""){
      if(isset($_SESSION["tienda"])){
        $_SESSION["tienda"] = $id; //Se cambia la tienda de la sesión
      }
      else{
        $_SESSION["tienda"] = $id; //Se cambia la tienda de la sesión
      }

      header("Location: " . RUTA_URL . "/public/home/index");
    }


    //Página para activar o desactivar una tienda
    public function activar($id = ""){
      $this->modelo->activarTienda($id); //Se activa/desactiva la tienda

      header("Location: " . RUTA_URL . "/public/tiendas"); //Se regresa al index
    }

  }
?>
