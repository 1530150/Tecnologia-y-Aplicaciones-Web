<?php
  //Clase home
  class Home extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("HomeModel");
    }

    //Método para ir a la página principal
    public function index(){
      $this->view("home/index", $this->modelo->getTotales());
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
          ?>
            <script>
              alert("El nombre de usuario o la contraseña son incorrectos");
            </script>
          <?php
          $this->view("home/login");
          }
      }
      else{
        $this->view("home/login");
      }
    }

    //Método para cerrar la sesión
    public function cerrarSesion(){
      if($this->modelo->sesionIniciada()){
        //Se elimina la sesión
        session_start();
        session_unset();
        session_destroy();

        //Regresa al login
        header("Location: " . RUTA_URL . "/public/home/login");
      }
    }
  }
?>
