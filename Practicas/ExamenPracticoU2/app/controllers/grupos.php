<?php
  //Controlador de grupos
  class Grupos extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("GruposModel");
    }

    //Página index
    public function index(){
      $this->view("grupos/index", $this->modelo->getGrupos());
    }

    //Página agregar grupo
    public function agregar(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["nombre"]),
        ];

        $this->modelo->agregarGrupo($datos); //Se agrega el grupo

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("grupos/agregar");
      }
    }

    //Página editar grupo
    public function editar($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "nombre" => trim($_POST["nombre"]),
        ];

        $this->modelo->editarGrupo($datos); //Se edita el grupo

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("grupos/editar", $this->modelo->getGrupo($id));
      }
    }

    //Método para eliminar grupo
    public function eliminar($id = ""){

      $this->modelo->eliminarGrupo($id); //Se elimina al grupo

      $this->index(); //Se regresa al index
    }
  }
?>
