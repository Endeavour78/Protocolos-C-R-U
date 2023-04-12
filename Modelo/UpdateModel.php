<?php
require_once('../Modelo/Conexion.php');

function ActualizarRegistros($datos)
{
    // Verificar que el arreglo no esté vacío
    if (!empty($datos)) {
        $cantidadInstalada = $datos[0]['cantidadInstalada'];
        $observaciones = $datos[0]['observaciones'];
        $idEquipo = $datos[0]['idEquipo'];

        // Realizar la conexión a la base de datos
        $conectar = conexion();

        // Verificar que la conexión sea exitosa
        if ($conectar === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Armar la consulta SQL con los datos
        $sql = "UPDATE Protocolos SET CANTIDADINSTALADA = $cantidadInstalada, OBSERVACIONES = '$observaciones' WHERE IDEQUIPO = $idEquipo";

        // Ejecutar la consulta
        $result = sqlsrv_query($conectar, $sql);

        // Verificar si la consulta se ejecutó con éxito
        if ($result) {
            // Si la consulta se ejecutó con éxito, devolver los datos actualizados como arreglo asociativo
            $resultados = array(
                'cantidadInstalada' => $cantidadInstalada,
                'observaciones' => $observaciones,
                'idEquipo' => $idEquipo
            );
            // Convertir el arreglo a JSON y devolverlo como respuesta
            return json_encode($resultados);
        } else {
            // Si la consulta no se ejecutó con éxito, devolver un mensaje de error como arreglo asociativo
            $error = array(
                'mensaje' => 'Error al actualizar los registros'
            );
            // Convertir el arreglo a JSON y devolverlo como respuesta
            return json_encode($error);
        }
    } else {
        // Si el arreglo está vacío, devolver un mensaje de error como arreglo asociativo
        $error = array(
            'mensaje' => 'Error al actualizar los registros'
        );
        // Convertir el arreglo a JSON y devolverlo como respuesta
        return json_encode($error);
    }
}
?>