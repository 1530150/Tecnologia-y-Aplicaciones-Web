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
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"); //Formato utf8

    $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $usuario, $password, $opciones); //Se realiza la conexión
  }

  //Función para desonectarse con la base de datos
  function desconectar(){
  	global $conexion;

  	$conexion = NULL;
  }

  //Función para agregar un jugador
  function agregarJugador($id, $nombre, $equipo, $posicion, $carrera, $email){
    global $conexion;

    $sql = "INSERT INTO jugadores VALUES(:id, :nombre, :equipo, :posicion, :carrera, :email)"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la Consulta

    //Se insertan los datos
    $respuesta->bindParam(":id", $id);
    $respuesta->bindParam(":nombre", $nombre);
    $respuesta->bindParam(":equipo", $equipo);
    $respuesta->bindParam(":posicion", $posicion);
    $respuesta->bindParam(":carrera", $carrera);
    $respuesta->bindParam(":email", $email);

    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();
  }

  //Función para modificar un jugador
  function modificarJugador($id, $nombre, $equipo, $posicion, $carrera, $email){
    global $conexion;

    $sql = "UPDATE jugadores SET nombre=:nombre, posicion=:posicion, carrera=:carrera, email=:email WHERE id=:id AND equipo=:equipo"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la Consulta

    //Se insertan los datos
    $respuesta->bindParam(":id", $id);
    $respuesta->bindParam(":nombre", $nombre);
    $respuesta->bindParam(":equipo", $equipo);
    $respuesta->bindParam(":posicion", $posicion);
    $respuesta->bindParam(":carrera", $carrera);
    $respuesta->bindParam(":email", $email);

    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();
  }

  //Función para eliminar un jugador
  function eliminarJugador($id, $equipo){
    global $conexion;

    $sql = "DELETE FROM jugadores WHERE id=:id AND equipo=:equipo"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la Consulta

    //Se insertan los datos
    $respuesta->bindParam(":id", $id);
    $respuesta->bindParam(":equipo", $equipo);

    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();
  }

  //Función para obtener los datos de un jugador
  function getJugador($id, $equipo){
    global $conexion;

    $sql = "SELECT * FROM jugadores WHERE id=:id AND equipo=:equipo"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la consulta

    //Se insertan los datos
    $respuesta->bindParam(":id", $id);
    $respuesta->bindParam(":equipo", $equipo);

    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();

    return $respuesta->fetch(PDO::FETCH_ASSOC); //Se retorna los datos del jugador
  }

  //Función para obtener todos los jugadores de un equipo con sus respectivos datos
  function getJugadores($equipo){
      global $conexion;

      $sql = "SELECT * FROM jugadores WHERE equipo=:equipo"; //Consulta

      conectar();
      $respuesta = $conexion->prepare($sql); //Se prepara la consulta

      //Se insertan los datos
      $respuesta->bindParam(":equipo", $equipo);

      $respuesta->execute(); //Se ejecuta la consulta
      desconectar();

      return $respuesta->fetchAll(); //La función retorna un array con los datos de los jugadores
  }

  //Función para obtener el número de jugadores de un equipo
  function getNumJugadores($equipo){
    global $conexion;

    $sql = "SELECT COUNT(*) FROM jugadores WHERE equipo=:equipo";

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la consulta

    //Se insertan los datos
    $respuesta->bindParam(":equipo", $equipo);

    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();

    return $respuesta->fetchColumn(); //La función retorna un array con los datos de los jugadores
  }

?>
