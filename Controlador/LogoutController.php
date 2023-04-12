<?php
// controlador logout.php
session_start();
session_destroy();
header("Location: ../Vistas/Login.php");
exit();
?>
