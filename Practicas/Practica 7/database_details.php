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

  //Función para agregar un nuevo usuario
  function agregarUsuario($nombre, $clave){
    global $conexion;

    $clave = md5($clave); //Se encripta la contraseña
    $sql = "INSERT INTO usuarios VALUES(:nombre, :clave)"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la Consulta
    //Se insertan los datos
    $respuesta->bindParam(":nombre", $nombre);
    $respuesta->bindParam(":clave", $clave);

    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();
  }

  //Función para agregar un nuevo producto
  function agregarProducto($nombre, $precio){
    global $conexion;

    $sql = "INSERT INTO productos VALUES(NULL, :nombre, :precio)"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la Consulta
    //Se insertan los datos
    $respuesta->bindParam(":nombre", $nombre);
    $respuesta->bindParam(":precio", $precio);

    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();
  }

  //Función para agregar un nuevo producto a la venta
  function agregarProductoVenta($producto, $cantidad){
    global $conexion;

    //Primero se comprueba si el producto ya está registrado en la base de datos
    $sql = "SELECT * FROM venta WHERE producto=:producto";
    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la Consulta
    //Se insertan los datos
    $respuesta->bindParam(":producto", $producto);;
    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();
    $respuesta = $respuesta->fetch(PDO::FETCH_ASSOC);

    //En caso de que exista...
    if($respuesta){
      print_r($respuesta);
      $cant = $respuesta["cantidad"]; //Se obtiene la cantidad existente
      $cant += $cantidad; //Se suma la cantidad existente con la nueva

      $sql = "UPDATE venta SET cantidad=:cantidad WHERE producto=:producto"; //Se actualiza la venta
      conectar();
      $respuesta = $conexion->prepare($sql); //Se prepara la Consulta
      //Se insertan los datos
      $respuesta->bindParam(":cantidad", $cant);
      $respuesta->bindParam(":producto", $producto);
      $respuesta->execute(); //Se ejecuta la consulta
      desconectar();
    }
    else{ //En caso de que no exista en la venta
      $sql = "INSERT INTO venta VALUES(:producto, :cantidad)"; //Consulta

      conectar();
      $respuesta = $conexion->prepare($sql); //Se prepara la Consulta
      //Se insertan los datos
      $respuesta->bindParam(":producto", $producto);
      $respuesta->bindParam(":cantidad", $cantidad);

      $respuesta->execute(); //Se ejecuta la consulta
      desconectar();
    }
  }

  //Función para obtener todos los productos registrados
  function getProductos(){
    global $conexion;

    $sql = "SELECT * FROM productos"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la consulta
    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();

    return $respuesta->fetchAll(); //La función retorna un array con los datos de los productos
  }

  //Función para obtener los detalles de la venta
  function getVenta(){
    global $conexion;

    $sql = "SELECT p.nombre, v.cantidad, (p.precio*v.cantidad) AS total FROM productos p INNER JOIN venta v ON p.id=v.producto"; //Consulta

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la consulta
    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();

    return $respuesta->fetchAll(); //La función retorna un array con los datos de los productos
  }

  //Función para iniciar sesión
  function validarLogin($nombre, $clave){
    global $user;
    global $conexion;

    $sql = "SELECT * FROM usuarios WHERE nombre=:nombre AND clave=:clave"; //Consulta
    $clave = md5($clave);

    conectar();
    $respuesta = $conexion->prepare($sql); //Se prepara la consulta
    $respuesta->bindParam(":nombre", $nombre);
    $respuesta->bindParam(":clave", $clave);
    $respuesta->execute(); //Se ejecuta la consulta
    desconectar();

    if($respuesta = $respuesta->fetch(PDO::FETCH_ASSOC)){
        session_start();
        $_SESSION["usuario"] = $nombre;
    }

    return $respuesta;
  }

  //Función para verificar si hay una sesión iniciada
  function sesionIniciada(){
      session_start();
      return isset($_SESSION['usuario']);
  }
?>
