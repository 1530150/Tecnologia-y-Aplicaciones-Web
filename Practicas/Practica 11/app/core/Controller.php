<?php
  class Controller{

    //Método para llamar al modelo
    public function model($model){
      require_once "../app/models/" . $model . ".php";
      return new $model();
    }

    //Método para llamar a la vista
    public function view($view, $data = []){
      if(file_exists("../app/views/" . $view . ".php")){
        require_once "../app/views/" . $view . ".php";
      }
      else{
        die("El archivo no existe");
      }
    }
  }
?>
