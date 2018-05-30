<?php
  //Nodelo Clientes
  class ClientesModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }
  }
?>
