<?php
require_once('../Modelo/InsertModel.php');

function Insert_Controller()
{
    // Verificamos la acción solicitada
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Si la acción es 'ControladorInsert', ejecutamos la inserción
    if ($action == 'ControladorInsert' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        // Decodificar los datos en formato JSON
        $datos = json_decode(file_get_contents("php://input"), true);

        // var_dump($datos);
        // Enviar los datos al modelo para insertar el nuevo registro
        $resultado = InsertarRegistros($datos);

        // Retornamos los resultados
        echo json_encode($resultado);
        exit;
    }
}

// Llamamos a la función Insert_Controller() para procesar la solicitud
Insert_Controller();
?>
