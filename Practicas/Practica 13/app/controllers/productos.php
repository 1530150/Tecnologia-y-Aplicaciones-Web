<?php
  //Controlador de productos
  class Productos extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("ProductosModel");
      session_start(); //Para poder acceder a la variable $_SESSION
    }

    //Página index
    public function index(){
      $productos = $this->modelo->getProductos($_SESSION["tienda"]);

      //Se recorren los registros guardados para cambiar el formato de la fecha
      for($i=0; $i<sizeof($productos); $i++){
        $productos[$i][3] = $this->acomodarFecha($productos[$i][3]);
      }

      $this->view("productos/index", $productos);
    }

    //Página para agregar un producto
    public function agregar(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "codigo" => trim($_POST["codigo"]),
          "nombre" => trim($_POST["nombre"]),
          "precio" => trim($_POST["precio"]),
          "stock" => trim($_POST["stock"]),
          "categoria" => trim($_POST["categoria"]),
          "nombre_img" => $_FILES["imagen"]["name"],
          "ruta_img" => $_FILES["imagen"]["tmp_name"],
          "tienda" => $_SESSION["tienda"]
        ];

        $this->modelo->agregarProducto($datos); //Se agrega el producto

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("productos/agregar", $this->modelo->getCategorias($_SESSION["tienda"]));
      }
    }

    //Página para editar un producto
    public function editar($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => trim($_POST["id"]),
          "codigo" => trim($_POST["codigo"]),
          "nombre" => trim($_POST["nombre"]),
          "precio" => trim($_POST["precio"]),
          "stock" => trim($_POST["stock"]),
          "categoria" => trim($_POST["categoria"]),
          "nombre_img" => $_FILES["imagen"]["name"],
          "ruta_img" => $_FILES["imagen"]["tmp_name"]
        ];

        $this->modelo->editarProducto($datos); //Se edita el producto

        $this->index(); //Se regresa al index
      }
      else{
        $this->view("productos/editar", [$this->modelo->getProducto($id), $this->modelo->getCategorias($_SESSION["tienda"])]);
      }
    }

    //Método para eliminar un producto
    public function eliminar($id = ""){
      $this->modelo->eliminarProducto($id); //Se elimina el producto

      $this->index(); //Se regresa al index
    }

    //Página para ver los detalles de un producto
    public function detalles($id = ""){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "id" => $id,
          "tipo" => trim($_POST["tipo"]),
          "cantidad" => intval(trim($_POST["cantidad"])),
          "referencia" => trim($_POST["referencia"]),
          "cantidad_actual" => intval(trim($_POST["cant_actual"])),
          "usuario" => trim($_POST["usuario"]),
          "usuario_user" => trim($_POST["usuario_user"]),
          "tienda" => $_SESSION["tienda"]
        ];

        $this->modelo->modificarStock($datos); //Se agrega el producto

        $historiales = $this->modelo->getHistorial($id);

        //Se recorren los registros guardados para cambiar el formato de la fecha
        for($i=0; $i<sizeof($historiales); $i++){
          $historiales[$i][3] = $this->acomodarFecha($historiales[$i][3]);
        }

        $this->view("productos/detalles", [$this->modelo->getProducto($id), $historiales]); //Se redirecciona de nuevo a la pág de detalles
      }
      else{
        $historiales = $this->modelo->getHistorial($id);

        //Se recorren los registros guardados para cambiar el formato de la fecha
        for($i=0; $i<sizeof($historiales); $i++){
          $historiales[$i][3] = $this->acomodarFecha($historiales[$i][3]);
        }

        $this->view("productos/detalles", [$this->modelo->getProducto($id), $historiales]);
      }
    }

  }
?>
