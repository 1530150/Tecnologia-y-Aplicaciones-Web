<?php
  //Controlador de usuarios
  class Ventas extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("VentasModel");
      session_start(); //Para poder acceder a la variable $_SESSION
    }

    //Página index
    public function index(){
      $ventas = $this->modelo->getVentas($_SESSION["tienda"]);

      //Se recorren los registros guardados para cambiar el formato de la fecha
      for($i=0; $i<sizeof($ventas); $i++){
        $ventas[$i][1] = $this->acomodarFecha($ventas[$i][1]);
      }

      $this->view("ventas/index", $ventas);
    }

    //Página para agregar una categoría
    public function agregar(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "productos" => $_POST["productos"],
          "cantidades" => $_POST["cantidades"],
          "cantidadesActuales" => $_POST["cantidadesActuales"],
          "total" => trim($_POST["total"]),
          "referencia" => trim($_POST["referencia"]),
          "tienda" => $_SESSION["tienda"],
          "usuario" => $_SESSION["id"],
          "nombre_usuario" => $_SESSION["usuario"]
        ];

        $this->modelo->agregarVenta($datos); //Se agrega la categoría

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("ventas/agregar", $this->modelo->getProductos($_SESSION["tienda"]));
      }
    }

    //Método para eliminar una categoría
    public function eliminar($id = ""){

      $this->modelo->eliminarVenta($id); //Se elimina la categoría

      $this->index(); //Se regresa al index
    }

  }
?>
