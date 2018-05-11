<?php
  $usuarios = []; //Array para almacenar todos los registros leídos del archivo
  $totalAlumnos = 0; //Variable para guardar el número total de alumnos registrados
  $totalProfesores = 0; //Variable para guardar el número total de profesores registrados

  //Se verifica que el archivo exista
  if(file_exists("usuarios.txt")){
    $file = file("usuarios.txt"); //Se lee el archivo

    //Ciclo para ir guardando cada registro dentro del array
    foreach ($file as $e){
      $usuarios[] = explode(",", $e); //La cadena se parte y cada dato se guarda en el array por separado

      //Se verifica el tipo de usuario. La primera posición contiene dicha información: 0 es un alumno, 1 es un profesor
      if($usuarios[sizeof($usuarios)-1][0] == 0){
        $totalAlumnos++; //Si el registro es un alumno entonces se aumentará la variable de alumnos
      }else{
        $totalProfesores++; //Si el registro es un profesor entonces se aumentará la variable de profesores
      }
    }
  }

  //Función para buscar un usuario en el arreglo
  function buscarUsuario($id){
    global $usuarios;

    //Se recorre el arreglo
    foreach($usuarios as $usuario){
      //Se verifica si el registro actual coincide con el id introducido, si lo encuentra entonces retorna ese registro
      if($id == $usuario[1]){
        return $usuario;
      }
    }
    return FALSE; //Si no encuentra el usuario entonces la función retorna FALSE
  }
?>
