<?php
  //Controlador de clientes
  class Clientes extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      //$this->modelo = $this->model("ClientesModel");
    }

    //Página index
    public function index(){
      $this->view("clientes/index");
    }

  }
?>
