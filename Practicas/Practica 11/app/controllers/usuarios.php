<?php
  //Controlador de usuarios
  class Usuarios extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      //$this->modelo = $this->model("UsuariosModel");
    }

    //Página index
    public function index(){
      $this->view("usuarios/index");
    }

  }
?>
