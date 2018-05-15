<?php
//Se cierra la sesión
session_start();
session_unset();
session_destroy();
//Se "elimina" la cookie
setcookie("usuario", "", time() - 3600);

header('Location: login.php'); //Se redirecciona al login
?>
