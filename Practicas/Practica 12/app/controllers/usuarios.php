<?php
  //Controlador de usuarios
  class Usuarios extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("UsuariosModel");
    }

    //Página index
    public function index(){
      $usuarios = $this->modelo->getUsuarios();

      //Se recorren los registros guardados para cambiar el formato de la fecha
      for($i=0; $i<sizeof($usuarios); $i++){
        $usuarios[$i][6] = $this->acomodarFecha($usuarios[$i][6]);
      }

      $this->view("usuarios/index", $usuarios);
    }

    //Página para agregar un usuario
    public function agregar(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["nombre"]),
          "apellido" => trim($_POST["apellido"]),
          "nombre_usuario" => trim($_POST["nombre_usuario"]),
          "password" => trim($_POST["password"]),
          "correo" => trim($_POST["correo"]),
          "nombre_img" => $_FILES["imagen"]["name"],
          "ruta_img" => $_FILES["imagen"]["tmp_name"]
        ];

        $this->modelo->agregarUsuario($datos); //Se agrega el usuario

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("usuarios/agregar");
      }
    }

    //Página para editar un usuario
    public function editar($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "nombre" => trim($_POST["nombre"]),
          "apellido" => trim($_POST["apellido"]),
          "nombre_usuario" => trim($_POST["nombre_usuario"]),
          "password" => trim($_POST["password"]),
          "correo" => trim($_POST["correo"]),
          "nombre_img" => $_FILES["imagen"]["name"],
          "ruta_img" => $_FILES["imagen"]["tmp_name"]
        ];

        $this->modelo->editarUsuario($datos); //Se edita el usuario

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("usuarios/editar", $this->modelo->getUsuario($id));
      }
    }

    //Método para eliminar un usuario
    public function eliminar($id = ""){

      $this->modelo->eliminarUsuario($id); //Se elimina el usuario

      $this->index(); //Se regresa al index
    }

  }
?>
