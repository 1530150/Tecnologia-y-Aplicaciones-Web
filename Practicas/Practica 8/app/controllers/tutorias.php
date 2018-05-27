<?php
  //Controlador de alumnos
  class Tutorias extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("TutoriasModel");
    }

    //Página index
    public function index($tutor=""){
      echo $tutor;
      $this->view("tutorias/index", [$this->modelo->getTutorias(), $tutor]);
    }

    //Pagina en donde se elegirá el tipo de tutoría (individual o grupal)
    public function tipoTutoria(){
      $this->view("tutorias/tipoTutoria");
    }

    //Página en donde se elegirá la cantidad de alumnos en la tutoría grupal
    public function cantidadAlumnos(){
      $this->view("tutorias/cantidadAlumnos");
    }

    //Página para agregar una tutoria
    public function agregarTutoria($tutor=""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "alumnos" => $_POST["alumno"],
          "tutor" => trim($_POST["tutor"]),
          "fecha" => trim($_POST["fecha"]),
          "hora" => trim($_POST["hora"]),
          "tipo" => trim($_POST["tipo"]),
          "descripcion" => trim($_POST["descripcion"])
        ];

        $this->modelo->agregarTutoria($datos); //Se agrega la tutoria

        $this->index(); //Se regresa al index
      }
      else{
        //Se muestra el registro de la tutoría
        $this->view("tutorias/agregarTutoria", [$this->modelo->getAlumnos($tutor), $this->modelo->getTutores($tutor)]);
      }
    }

    /*
    //Página editar la tutoría
    public function editarTutoria($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "alumno" => trim($_POST["alumno"]),
          "tutor" => trim($_POST["tutor"]),
          "fecha" => trim($_POST["fecha"]),
          "hora" => trim($_POST["hora"]),
          "tipo" => trim($_POST["tipo"]),
          "descripcion" => trim($_POST["descripcion"])
        ];

        $this->modelo->editarTutoria($datos); //Se edita la tutoria

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("tutorias/editarTutoria", [$this->modelo->getTutoria($id), $this->modelo->getAlumnos(), $this->modelo->getTutores()]);
      }
    }

    //Método para eliminar tutoria
    public function eliminarTutoria($id = ""){

      $this->modelo->eliminarTutoria($id); //Se elimina la tutoria

      $this->index(); //Se regresa al index
    }
    */
  }
?>
