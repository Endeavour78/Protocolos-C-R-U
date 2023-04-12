<?php
require_once('../Modelo/TableModel.php');

function BuscarInfo()
{
    // Verificamos la acción solicitada
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Si la acción es buscar, ejecutamos la búsqueda
    if ($action == 'BuscarInfo') {

        // Realizamos la consulta
        $resultado = buscar_Info();

        // Retornamos los resultados
        echo json_encode($resultado);
        exit;

    }
}

// llamamos a la función BuscarInfo() para procesar la solicitud
BuscarInfo();