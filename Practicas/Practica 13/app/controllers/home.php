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
    public function index(){
      $this->view("home/index", $this->modelo->getTotales($_SESSION["tienda"]));
    }

    //Página login
    public function login(){
      //Es true cuando un post se envia, en este caso cuando se envía el formulario del login
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $datos = [
          "usuario" => trim($_POST["usuario"]),
          "clave" => trim($_POST["clave"]),
        ];

        //Se valida el login. Si es correcto entra, si no se muestra una alerta y queda ahí
        if($this->modelo->validarLogin($datos)){
          header("Location: " . RUTA_URL . "/public/home/index");
        }
        else{
          //Si se ingresó un usuario o contraseña incorrectos, se pasa un parámetro que sirve como bandera para mostrar un mensaje
          $this->view("home/login", "mal");
          }
      }
      else{
        $this->view("home/login");
      }
    }

    //Método para cerrar la sesión
    public function cerrarSesion(){
      if($this->sesionIniciada()){
        //Se elimina la sesión
        session_unset();
        session_destroy();

        //Regresa al login
        header("Location: " . RUTA_URL . "/public/home/login");
      }
    }

    //Método para salir de la tienda
    public function cerrarTienda(){
      $_SESSION["tienda"] = 1; //Se cambia la tienda de la sesión por la del administrador

      //Regresa al inicio
      header("Location: " . RUTA_URL . "/public/home/");
    }

    //Método para verificar si hay una sesión iniciada
    public function sesionIniciada(){
        return isset($_SESSION["usuario"]);
    }
  }
?>
