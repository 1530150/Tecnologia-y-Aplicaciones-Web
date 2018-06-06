<?php
  //Controlador de usuarios
  class Categorias extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("CategoriasModel");
    }

    //Página index
    public function index(){
      $categorias = $this->modelo->getCategorias();

      //Se recorren los registros guardados para cambiar el formato de la fecha
      for($i=0; $i<sizeof($categorias); $i++){
        $categorias[$i][3] = $this->acomodarFecha($categorias[$i][3]);
      }

      $this->view("categorias/index", $categorias);
    }

    //Página para agregar una categoría
    public function agregar(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["nombre"]),
          "descripcion" => trim($_POST["descripcion"])
        ];

        $this->modelo->agregarCategoria($datos); //Se agrega la categoría

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("categorias/agregar");
      }
    }

    //Página para editar una categoría
    public function editar($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "nombre" => trim($_POST["nombre"]),
          "descripcion" => trim($_POST["descripcion"])
        ];

        $this->modelo->editarCategoria($datos); //Se edita la categoría

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("categorias/editar", $this->modelo->getCategoria($id));
      }
    }

    //Método para eliminar una categoría
    public function eliminar($id = ""){

      $this->modelo->eliminarCategoria($id); //Se elimina la categoría

      $this->index(); //Se regresa al index
    }

  }
?>
