<?php
session_start();
require_once '../Modelo/LoginModel.php';

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user = getUser($username, $password);

  if ($user) {
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = $username;
    $_SESSION['nombre'] = $user['nombre'];
    header("Location: ../Vistas/Home.php");
    exit();
  } else {
    // Si el usuario o contraseña son incorrectos, mostramos una alerta de error
    $mensajeError = "Usuario o contraseña incorrectos";
    $_SESSION['mensajeError'] = $mensajeError;
    header("Location: ../Vistas/Login.php");
    exit();
  }
} else {
  header("Location: ../Vistas/Login.php");
  exit();
}
