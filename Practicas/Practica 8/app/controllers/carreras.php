<?php
  //Controlador de alumnos
  class Carreras extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("CarrerasModel");
    }

    //Página index
    public function index(){
      $this->view("carreras/index", $this->modelo->getCarreras());
    }

    //Página agregar alumno
    public function agregarCarrera(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["nombre"]),
        ];

        $this->modelo->agregarCarrera($datos); //Se agrega el alumno

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("carreras/agregarCarrera");
      }
    }

    //Página editar alumno
    public function editarCarrera($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "nombre" => trim($_POST["nombre"]),
        ];

        $this->modelo->editarCarrera($datos); //Se edita el alumno

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("carreras/editarCarrera", $this->modelo->getCarrera($id));
      }
    }

    //Método para eliminar alumno
    public function eliminarCarrera($id = ""){

      $this->modelo->eliminarCarrera($id); //Se elimina al alumno

      $this->index(); //Se regresa al index
    }
  }
?>
