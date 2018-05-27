<?php
  //Controlador de alumnos
  class Alumnos extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("AlumnosModel");
    }

    //Página index
    public function index(){
      $this->view("alumnos/index", $this->modelo->getAlumnos());
    }

    //Página agregar alumno
    public function agregarAlumno(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "matricula" => trim($_POST["matricula"]),
          "nombre" => trim($_POST["nombre"]),
          "carrera" => trim($_POST["carrera"]),
          "tutor" => trim($_POST["tutor"])
        ];

        $this->modelo->agregarAlumno($datos); //Se agrega el alumno

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("alumnos/agregarAlumno", [$this->modelo->getCarreras(), $this->modelo->getTutores()]);
      }
    }

    //Página editar alumno
    public function editarAlumno($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "matricula" => trim($_POST["matricula"]),
          "nombre" => trim($_POST["nombre"]),
          "carrera" => trim($_POST["carrera"]),
          "tutor" => trim($_POST["tutor"])
        ];

        $this->modelo->editarAlumno($datos); //Se edita el alumno

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("alumnos/editarAlumno", [$this->modelo->getAlumno($id), $this->modelo->getCarreras(), $this->modelo->getTutores()]);
      }
    }

    //Método para eliminar alumno
    public function eliminarAlumno($id = ""){

      $this->modelo->eliminarAlumno($id); //Se elimina al alumno

      $this->index(); //Se regresa al index
    }
  }
?>
