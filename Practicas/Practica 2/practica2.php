<?php
  //_________________________________Parte 1_________________________________
  $arreglo = array(20, 12, 32, 5, 16, 2, 9, 16, 22);

  echo "<h1>Parte 1</h1>";
  sort($arreglo);
  echo "sort: ";
  print_r($arreglo);

  rsort($arreglo);
  echo "<br><br> rsort: ";
  print_r($arreglo);


  //_________________________________Parte 2_________________________________
  echo "<h1>Parte 2</h1>";
  echo "<b>Brian Elí Becerra Hernández</b><br> Ciudad Victoria";


  //_________________________________Parte 3_________________________________
  echo "<h1>Parte 3</h1>";

  $arreglo2 = array(21, 43, 53, 12, 33, 44, 6, 19, 16, 20);

  foreach($arreglo2 as $valor){
    echo $valor, " ";
  }



?>
