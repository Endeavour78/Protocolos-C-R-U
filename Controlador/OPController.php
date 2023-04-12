<?php
require_once('../Modelo/OPModel.php');

function BuscarControlador()
{
    // Verificamos la acción solicitada
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Si la acción es buscar, ejecutamos la búsqueda
    if ($action == 'BuscarControlador') {

        // Recibimos el valor de OP por GET
        $op = isset($_GET['op']) ? $_GET['op'] : '';

        // Realizamos la consulta
        $resultado = buscar_OP($op);

        // Retornamos los resultados
        echo json_encode($resultado);
        exit;

    }
}

// llamamos a la función BuscarControlador() para procesar la solicitud
BuscarControlador();