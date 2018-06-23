<?php
  //Clase home
  class Home extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("HomeModel");
      session_start(); //Para poder acceder a la variable $_SESSION
    }

    //Método para ir a la página principal
    public function index($grupo = ""){
      $this->view("home/index", [$this->modelo->getGrupos(), $this->modelo->getAlumnasGrupo($grupo), $grupo]);
    }

    //Método para ir a la página para visualizar los lugares de registros
    public function lugares(){
      $this->view("home/lugares", $this->modelo->getPagos());
    }

    //Método para ir a la página para visualizar los lugares de registros
    public function pagos(){
      $this->view("home/pagos", $this->modelo->getPagos());
    }

    //Página login
    public function admin(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "nombre" => trim($_POST["usuario"]),
          "clave" => trim($_POST["clave"]),
        ];

        //Se valida el login. Si es correcto entra, si no se muestra una alerta y queda ahí
        if($this->modelo->validarLogin($datos)){
          header("Location: " . RUTA_URL . "/public/home/pagos/");
        }
        else{
          //Si se ingresó un usuario o contraseña incorrectos, se pasa un parámetro que sirve como bandera para mostrar un mensaje
          $this->view("home/admin", "mal");
          }
      }
      else{
        $this->view("home/admin");
      }
    }

    //Método para cerrar la sesión
    public function cerrarSesion(){
      if($this->sesionIniciada()){
        //Se elimina la sesión
        session_unset();
        session_destroy();

        //Regresa al login
        header("Location: " . RUTA_URL . "/public/home/");
      }
    }

    //Página agregar un pago
    public function agregarPago(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario de registro
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "grupo" => trim($_POST["grupo"]),
          "alumna" => trim($_POST["alumna"]),
          "nombre_mama" => trim($_POST["nombre_mama"]),
          "apellido_mama" => trim($_POST["apellido_mama"]),
          "fecha_pago" => trim($_POST["fecha_pago"]),
          "folio" => trim($_POST["folio"]),
          "nombre_img" => $_FILES["folio_img"]["name"],
          "ruta_img" => $_FILES["folio_img"]["tmp_name"]
        ];

        $this->modelo->agregarPago($datos); //Se agrega el pago

        $this->lugares(); //Se regresa al index
      }
  }

  //Método para verificar si hay una sesión iniciada
  public function sesionIniciada(){
      return isset($_SESSION["usuario"]);
  }

}
?>
