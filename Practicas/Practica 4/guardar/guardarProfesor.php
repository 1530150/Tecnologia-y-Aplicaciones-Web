<?php
  //Se verifica que todos los campos del formulario hayan sido llenados
  if(isset($_POST["numEmp"]) && isset($_POST["nombre"]) && isset($_POST["carrera"]) && isset($_POST["telefono"])){
    $numEmp = $_POST["numEmp"];
    $nombre = $_POST["nombre"];
    $carrera = $_POST["carrera"];
    $telefono = $_POST["telefono"];

    $file = fopen("../usuarios.txt","a"); //Se abre el archivo
    fputs($file, "1, $numEmp, $nombre, $carrera, $telefono \r\n"); //Se escribe en el archivo la información del formulario
    fclose($file); //Se cierra el archivo

    header("Location: ../"); //Se regresa al index
  }else{
    header("Location: ../form-profesores.php"); //Si algun campo no se llenó entonces la página redireccionará al formulario
  }
 ?>
