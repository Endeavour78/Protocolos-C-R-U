<?php
require_once('../Modelo/Conexion.php');

function InsertarRegistros($datos)
{
    try {
        // Verificar que el arreglo no esté vacío
        if (!empty($datos)) {
            $codigo = $datos['codigo'];
            $descripcion = $datos['descripcion'];
            $referencia = $datos['referencia'];
            $op = $datos['op'];

            // Realizar la conexión a la base de datos
            $conectar = conexion();

            // Verificar que la conexión sea exitosa
            if ($conectar === false) {
                // Lanzar una excepción con un mensaje de error
                throw new Exception('Error de conexión a la base de datos');
            }

            // Utilizar una consulta preparada para proteger contra la inyección SQL
            $consulta = "INSERT INTO Protocolos (DESCRIPCION, REFERENCIA, NUMEROTABLERO, NUMEROORDEN) VALUES (?, ?, ?, ?)";
            $params = array($descripcion, $referencia, $codigo, $op);
            $resultado = sqlsrv_query($conectar, $consulta, $params);

            // Verificar si la consulta se ejecutó con éxito
            if ($resultado) {
                // Si la consulta se ejecutó con éxito, devolver los datos insertados como arreglo asociativo
                $resultados = array(
                    'success' => true,
                    'message' => 'Registro insertado con éxito',
                    'data' => array(
                        'codigo' => $codigo,
                        'descripcion' => $descripcion,
                        'referencia' => $referencia,
                        'op' => $op
                    )
                );
                // Convertir el arreglo a JSON y devolverlo como respuesta
                echo json_encode($resultados);
            } else {
                // Lanzar una excepción con un mensaje de error
                throw new Exception('Error al insertar los registros en la base de datos');
            }
        } else {
            // Lanzar una excepción con un mensaje de error
            throw new Exception('Datos vacíos');
        }
    } catch (Exception $e) {
        // Capturar la excepción y devolver una respuesta JSON adecuada
        $resultados = array(
            'success' => false,
            'message' => $e->getMessage(),
            'data' => null
        );
        echo json_encode($resultados);
    }
}
