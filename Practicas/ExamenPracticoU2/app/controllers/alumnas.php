<?php
  //Controlador de alumnas
  class Alumnas extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("AlumnasModel");
    }

    //Página index
    public function index(){
      $this->view("alumnas/index", $this->modelo->getAlumnas());
    }

    //Página agregar alumna
    public function agregar(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["nombre"]),
          "apellido" => trim($_POST["apellido"]),
          "fecha_nacimiento" => trim($_POST["fecha_nacimiento"]),
          "grupo" => trim($_POST["grupo"])
        ];

        $this->modelo->agregarAlumna($datos); //Se agrega la alumna

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("alumnas/agregar", $this->modelo->getGrupos());
      }
    }

    //Página editar una alumna
    public function editar($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "nombre" => trim($_POST["nombre"]),
          "apellido" => trim($_POST["apellido"]),
          "fecha_nacimiento" => trim($_POST["fecha_nacimiento"]),
          "grupo" => trim($_POST["grupo"])
        ];

        $this->modelo->editarAlumna($datos); //Se edita la alumna

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("alumnas/editar", [$this->modelo->getAlumna($id), $this->modelo->getGrupos()]);
      }
    }

    //Método para eliminar una alumna
    public function eliminar($id = ""){

      $this->modelo->eliminarAlumna($id); //Se elimina a la alumna

      $this->index(); //Se regresa al index
    }
  }
?>
