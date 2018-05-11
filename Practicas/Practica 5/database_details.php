<?php
  require_once("conexion.php");

  $conexion = NULL;

  //Función para realizar la conexión con la base de datos
  function conectar(){
    //Varlables requeridas para concretar la conexión
    global $conexion;
    global $servidor;
    global $usuario;
    global $password;
    global $bd;

    $conexion = mysqli_connect($servidor, $usuario, $password, $bd); //Se realiza la conexión
  	mysqli_set_charset($conexion, 'utf8'); //Se utiliza el formato utf8
  }

  //Función para desonectarse con la base de datos
  function desconectar(){
  	global $conexion;

  	mysqli_close($conexion); //Se cierra la conexión
  }

  //Función para agregar un usuario
  function agregarUsuario($nombre, $edad, $correo, $telefono, $direccion){
    global $conexion;

    conectar();
    $sql = "INSERT INTO usuarios VALUES(NULL, '$nombre', '$edad', '$correo', '$telefono', '$direccion')"; //Consulta
    mysqli_query($conexion, $sql); //Se ejecuta la consulta en la base de datos
    desconectar();
  }

  //Función para modificar un usuario
  function modificarUsuario($id, $nombre, $edad, $correo, $telefono, $direccion){
    global $conexion;

    //Consulta
    conectar();
    $sql = "UPDATE usuarios SET nombre='$nombre', edad='$edad', correo='$correo', telefono='$telefono', direccion='$direccion' WHERE id='$id'";
    mysqli_query($conexion, $sql); //Se ejecuta la consulta en la base de datos
    desconectar();
  }

  function eliminarUsuario($id){
    global $conexion;

    //Consulta
    conectar();
    $sql = "DELETE FROM usuarios WHERE id = '$id'";
    mysqli_query($conexion, $sql); //Se ejecuta la consulta en la base de datos
    desconectar();
  }

  //Función para obtener los datos de un usuario
  function getUsuario($id){
      global $conexion;

      conectar();
      $respuesta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id='".$id."'"); //Consulta
      desconectar();

      return mysqli_fetch_array($respuesta); //La función retorna un array con los datos del usuario
  }

  //Función para obtener todos los usuarios con sus respectivos datos
  function getUsuarios(){
      global $conexion;

      conectar();
      $respuesta = mysqli_query($conexion, "SELECT * FROM usuarios"); //Consulta
      desconectar();

      return $respuesta->fetch_all(); //La función retorna un array con los datos de los usuarios
  }
?>
