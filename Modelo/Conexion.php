<?php

function conexion()
{
     $serverName = "(local)";
     $databaseName = "prueba";
     $connectionOptions = array(
          "Database" => $databaseName,
          "TrustServerCertificate" => true,
          "CharacterSet" => "UTF-8"
     );

     // Establecemos la conexión utilizando sqlsrv_connect
     $conn = sqlsrv_connect($serverName, $connectionOptions);

     // Verificamos si la conexión se ha establecido correctamente
     if ($conn === false) {
          // Si la conexión ha fallado, manejamos el error
          die(print_r(sqlsrv_errors(), true));
     } else {
          // Si la conexión ha sido exitosa, regresamos la instancia de la conexión
          return $conn;
     }
}
