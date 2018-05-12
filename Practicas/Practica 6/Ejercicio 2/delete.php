<?php
  require_once("database_details.php");

  eliminarJugador($_GET["id"][0], $_GET["id"][1]); //Se llama a la función para eliminar al jugador

  header("Location: jugadores.php?equipo=".$_GET["id"][1]); //Se redirecciona a la lista de jugadores
?>
