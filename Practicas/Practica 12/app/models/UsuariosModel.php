<?php
  //Nodelo Usuarios
  class UsuariosModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }
  }
?>
