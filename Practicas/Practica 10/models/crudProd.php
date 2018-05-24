<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "conexion.php";

//heredar la clase conexion de conexion.php para poder utilizar "Conexion" del archivo conexion.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del models/conexion.php:
class DatosProd extends Conexion{

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function registroProductoModel($datosModel){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO products VALUES (null, :nombre, :descripcion, :precioC, :precioV, :proce)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":precioC", $datosModel["precioC"], PDO::PARAM_INT);
		$stmt->bindParam(":precioV", $datosModel["precioV"], PDO::PARAM_INT);
		$stmt->bindParam(":proce", $datosModel["proce"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}











	#VISTA USUARIOS
	#-------------------------------------
	public function vistaProductosModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM products");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		$stmt->close();

	}

	#EDITAR USUARIO
	#-------------------------------------

	public function editarProductoModel($datosModel){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM products WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_NUM);

		$stmt->close();

	}

	#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarProductoModel($datosModel){

		$stmt = Conexion::conectar()->prepare("UPDATE products SET nombreProd=:nombre, descProduc=:descripcion, BuyPrice=:precioC, SalePrice=:precioV, Proce=:proce WHERE id=:id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":precioC", $datosModel["precioC"], PDO::PARAM_INT);
		$stmt->bindParam(":precioV", $datosModel["precioV"], PDO::PARAM_INT);
		$stmt->bindParam(":proce", $datosModel["proce"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


	#BORRAR USUARIO
	#------------------------------------
	public function borrarProductoModel($datosModel){

		$stmt = Conexion::conectar()->prepare("DELETE FROM products WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

}




/*

#REGISTRO DE PRODUCTOS
	#-------------------------------------
	public function registroProductosModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt1 = Conexion::conectar()->prepare("INSERT INTO $tabla (nombreProd, descProduc, BuyPrice,SalePrice, Proce) VALUES (:nombreProd,:descProduc,:BuyPrice,:SalePrice,:Proce)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt1->bindParam(":nombreProd", $datosModel["nombreProd"], PDO::PARAM_STR);
		$stmt1->bindParam(":descProduc", $datosModel["descProduc"], PDO::PARAM_STR);
		$stmt1->bindParam(":BuyPrice", $datosModel["BuyPrice"], PDO::PARAM_STR);
		$stmt1->bindParam(":SalePrice", $datosModel["SalePrice"], PDO::PARAM_STR);
		$stmt1->bindParam(":Proce", $datosModel["Proce"], PDO::PARAM_STR);


		if($stmt1->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt1->close();

	}

*/

?>
