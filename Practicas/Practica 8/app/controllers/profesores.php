<?php
  //Controlador de profesores
  class Profesores extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("ProfesoresModel");
    }

    //Página index
    public function index(){
      $this->view("profesores/index", $this->modelo->getProfesores());
    }

    //Página agregar profesor
    public function agregarProfesor(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["nombre"]),
          "email" => trim($_POST["email"]),
          "tipo" => trim($_POST["tipo"]),
          "password" => trim($_POST["password"]),
          "carrera" => trim($_POST["carrera"])
        ];

        $this->modelo->agregarProfesor($datos); //Se agrega el profesor

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("profesores/agregarProfesor", [$this->modelo->getCarreras()]);
      }
    }

    //Página editar profesor
    public function editarProfesor($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "numEmp" => trim($_POST["numEmp"]),
          "nombre" => trim($_POST["nombre"]),
          "email" => trim($_POST["email"]),
          "tipo" => trim($_POST["tipo"]),
          "password" => trim($_POST["password"]),
          "carrera" => trim($_POST["carrera"])
        ];

        $this->modelo->editarProfesor($datos); //Se edita el profesor

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("profesores/editarProfesor", [$this->modelo->getProfesor($id), $this->modelo->getCarreras()]);
      }
    }

    //Método para eliminar profesor
    public function eliminarProfesor($id = ""){

      $this->modelo->eliminarProfesor($id); //Se elimina al profesor

      $this->index(); //Se regresa al index
    }
  }
?>
