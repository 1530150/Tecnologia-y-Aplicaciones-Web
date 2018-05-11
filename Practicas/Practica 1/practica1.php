<?php
  //_______________________________Parte 1_______________________________
  echo "<h1>Parte1<h2>";
  $persona1 = array('nombre' => "Brian",
                    'apellido' => "Becerra");
  $persona2 = array('nombre' => "Cinthia");

  echo "Persona 1: ", $persona1['nombre'], " ", $persona1['apellido'], "<br>",
        "Persona 2: ", $persona2['nombre'], " ", $persona1['apellido'], "<br><br>";





  //_______________________________Parte 2_______________________________
  echo "<h1>Parte2<h2>";

  $numeros = array(23,4,19,9,12,16);

  foreach ($numeros as $numero) {
    if($numero == 4){
      echo $numero;
    }
  }
  echo "<br><br>";

  sort($numeros);
  echo "sort: " ;
  print_r($numeros);

  echo "<br>";

  rsort($numeros);
  echo "rsort: " ;
  print_r($numeros);
?>
