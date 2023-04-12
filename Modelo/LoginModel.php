<?php
require_once('../Modelo/Conexion.php');

function getUser($username, $password)
{
    $conn = conexion();
    $query = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $stmt = sqlsrv_prepare($conn, $query, array(&$username, &$password));
    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    if ($user) {
        return $user;
    }
    return false;
}

