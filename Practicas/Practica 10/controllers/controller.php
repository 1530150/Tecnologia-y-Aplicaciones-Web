<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){

		include "views/template.php";

	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){

			$enlaces = $_GET['action'];

		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}






	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosController = array( "usuario"=>$_POST["usuarioRegistro"],
								      "password"=>$_POST["passwordRegistro"],
								      "email"=>$_POST["emailRegistro"]);

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

			//se imprime la respuesta en la vista
			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
			}

		}

	}


	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroProductoController(){

		if(isset($_POST["nombre"])){
			//Recibe a traves del método POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email):
			$datosController = array(
											"nombre"=>$_POST["nombre"],
								      "descripcion"=>$_POST["descripcion"],
								      "precioC"=>$_POST["precioC"],
											"precioV"=>$_POST["precioV"],
											"proce"=>$_POST["proce"]);

			//Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),que en la clase "Datos", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = DatosProd::registroProductoModel($datosController);

			//se imprime la respuesta en la vista
			if($respuesta == "success"){

				header("location:index.php?action=productos");

			}

			else{

				header("location:index.php");
			}

		}

	}










	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( "usuario"=>$_POST["usuarioIngreso"],
								      "password"=>$_POST["passwordIngreso"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
			//Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

				session_start();

				$_SESSION["validar"] = true;

				header("location:index.php?action=usuarios");

			}

			else{

				header("location:index.php?action=fallo");

			}

		}

	}

	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["usuario"].'</td>
				<td>'.$item["password"].'</td>
				<td>'.$item["email"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	public function vistaProductosController(){

		$respuesta = DatosProd::vistaProductosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item[0].'</td>
				<td>'.$item[1].'</td>
				<td>'.$item[2].'</td>
				<td>'.$item[3].'</td>
				<td>'.$item[4].'</td>
				<td>'.$item[5].'</td>
				<td><a href="index.php?action=editarProducto&id='.$item[0].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=productos&idBorrarProd='.$item[0].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

			 <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

			 <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

	}

	#EDITAR PRODUCTO
	#------------------------------------

	public function editarProductoController(){

		$datosController = $_GET["id"];
		$respuesta = DatosProd::editarProductoModel($datosController);

		echo'<input type="hidden" value="'.$respuesta[0].'" name="id">

			 <input type="text" value="'.$respuesta[1].'" name="nombre" required>

			 <input type="text" value="'.$respuesta[2].'" name="descripcion" required>

			 <input type="text" value="'.$respuesta[3].'" name="precioC" required>

			 <input type="text" value="'.$respuesta[3].'" name="precioV" required>

			 <input type="text" value="'.$respuesta[4].'" name="proce" required>

			 <input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			$datosController = array( "id"=>$_POST["idEditar"],
							          "usuario"=>$_POST["usuarioEditar"],
				                      "password"=>$_POST["passwordEditar"],
				                      "email"=>$_POST["emailEditar"]);

			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=cambio");

			}

			else{

				echo "error";

			}

		}

	}

	#ACTUALIZAR PRODUCTO
	#------------------------------------
	public function actualizarProductoController(){

		if(isset($_POST["nombre"])){

			$datosController = array(
												"id"=>$_POST["id"],
							          "nombre"=>$_POST["nombre"],
												"descripcion"=>$_POST["descripcion"],
												"precioC"=>$_POST["precioC"],
												"precioV"=>$_POST["precioV"],
												"proce"=>$_POST["proce"]);

			$respuesta = DatosProd::actualizarProductoModel($datosController);

			if($respuesta == "success"){

				header("location:index.php?action=productos");

			}

			else{

				echo "error";

			}

		}

	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "sxss"){

				header("location:index.php?action=usuarios");

			}

		}

	}

	#BORRAR PRODUCTO
	#------------------------------------
	public function borrarProductoController(){

		if(isset($_GET["idBorrarProd"])){

			$datosController = $_GET["idBorrarProd"];

			$respuesta = DatosProd::borrarProductoModel($datosController);

			if($respuesta == "sxss"){

				header("location:index.php?action=productos");

			}

		}

	}

}






////
?>
