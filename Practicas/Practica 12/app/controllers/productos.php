<?php
  //Controlador de productos
  class Productos extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      //$this->modelo = $this->model("ProductosModel");
    }

    //Página index
    public function index(){
      $this->view("productos/index");
    }

  }
?>
