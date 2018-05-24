<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>PRODUCTOS</h1>

	<table border="1">

		<thead>

			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Precio de compra</th>
				<th>Precio de venta</th>
				<th>Proce</th>
				<th>Editar?</th>
				<th>Eliminar?</th>

			</tr>

		</thead>

		<tbody>

			<?php

			$vistaUsuario = new MvcController();
			$vistaUsuario -> vistaProductosController();
			$vistaUsuario -> borrarProductoController();

			?>

		</tbody>

	</table>

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";

	}

}

?>
