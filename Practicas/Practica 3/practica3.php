<?php
  class Arreglo{
    public $arreglo = [];

    public function insertar($dato){
      $this->arreglo[] = $dato;
    }

    public function imprimir(){
      foreach($this->arreglo as $valor){
        echo $valor, " ";
      }
      echo "<br>";
    }

  }

  class ArregloFibonacci extends Arreglo{
    public function copiar(Arreglo $arreglo){
      $this->arreglo = $arreglo->arreglo;
    }

    /*public function fibonacci(){
      for($i=2; $i<sizeof($this->arreglo); $i++){
          $this->arreglo[$i] = $this->arreglo[$i-2] + $this->arreglo[$i-1];
      }
    }*/

    public function fibonacci(){
      $temp = $this->arreglo;

      for($i=2; $i<sizeof($this->arreglo); $i++){
          $this->arreglo[$i] = $temp[$i-2] + $temp[$i-1];
      }
    }

  }


  $arreglo1 = new Arreglo();
  $arreglo2 = new ArregloFibonacci();

  $arreglo1->insertar(2);
  $arreglo1->insertar(4);
  $arreglo1->insertar(12);
  $arreglo1->insertar(13);
  $arreglo1->insertar(21);
  $arreglo1->insertar(16);
  $arreglo1->insertar(9);
  $arreglo1->insertar(29);
  $arreglo1->insertar(18);
  $arreglo1->insertar(32);
  $arreglo1->insertar(41);
  $arreglo1->insertar(20);
  $arreglo1->insertar(5);
  $arreglo1->insertar(15);
  $arreglo1->insertar(30);
  $arreglo1->insertar(36);
  $arreglo1->insertar(21);
  $arreglo1->insertar(19);
  $arreglo1->insertar(52);
  $arreglo1->insertar(45);
  $arreglo1->insertar(42);
  $arreglo1->insertar(46);
  $arreglo1->insertar(9);
  $arreglo1->insertar(62);
  $arreglo1->insertar(22);

  echo "<h3>Arreglo</h3>";
  $arreglo1->imprimir();

  $arreglo2->copiar($arreglo1);
  $arreglo2->fibonacci();

  echo "<h3>Arreglo fibonacci</h3>";
  $arreglo2->imprimir();
?>
