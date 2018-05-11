<?php
  //Se verifica que todos los campos del formulario hayan sido llenados
  if(isset($_POST["matricula"]) && isset($_POST["nombre"]) && isset($_POST["carrera"]) && isset($_POST["email"]) && isset($_POST["telefono"])){
    $matricula = $_POST["matricula"];
    $nombre = $_POST["nombre"];
    $carrera = $_POST["carrera"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];

    $file = fopen("../usuarios.txt","a"); //Se abre el archivo
    fputs($file,"0, $matricula, $nombre, $carrera, $email, $telefono \r\n"); //Se escribe en el archivo la información del formulario
    fclose($file); //Se cierra el archivo

    header("Location: ../"); //Se regresa al index
  }else{
    header("Location: ../form-alumnos.php"); //Si algun campo no se llenó entonces la página redireccionará al formulario
  }
 ?>
