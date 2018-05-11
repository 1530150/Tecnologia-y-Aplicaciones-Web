<?php
  require_once("database_details.php");

  eliminarUsuario($_GET["id"]); //Se llama a la función para eliminar al usuario

  header("Location: index.php"); //Se redirecciona al indexs
?>
