<?php
  //Nodelo Productos
  class ProductosModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }
  }
?>
