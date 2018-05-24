<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>REGISTRO DE PRODUCTO</h1>

<form method="post">

	<input type="text" placeholder="Nombre" name="nombre" required>

	<input type="text" placeholder="Descripción" name="descripcion" required>

	<input type="text" placeholder="Precio de compra" name="precioC" required>

	<input type="text" placeholder="Precio de venta" name="precioV" required>

	<input type="text" placeholder="Proce" name="proce" required>

	<input type="submit" value="Enviar">

</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new MvcController();
//se invoca la función registroUsuarioController de la clase MvcController:
$registro -> registroProductoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";

	}

}

?>
