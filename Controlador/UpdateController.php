<?php
require_once('../Modelo/UpdateModel.php');

function update_controller()
{
    // Verificamos la acción solicitada
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Si la acción es ControladorUpdate, ejecutamos la actualización
    if ($action == 'ControladorUpdate' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        // Decodificar los datos en formato JSON
        $datos = json_decode(file_get_contents("php://input"), true);

        // Enviar los datos al modelo para actualizar los registros
        $resultado = ActualizarRegistros($datos);

        // Retornamos los resultados
        echo json_encode($resultado);
        exit;
    }
}

// Llamamos a la función update_controller() para procesar la solicitud
update_controller();