<?php
require_once('../Modelo/Conexion.php');

function buscar_OP()
{

    $conectar = conexion();

    // Verificamos que la conexión sea exitosa
    if ($conectar === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Recibimos el valor de OP por GET
    $op = $_GET['op'];

    // Primera consulta
    $consulta = "SELECT CANTIDAD FROM OPS2 WHERE OPERACION = '$op'";
    $resultado = sqlsrv_query($conectar, $consulta);

    // Si hay resultados en la primera consulta, los retornamos directamente
    if ($resultado && sqlsrv_has_rows($resultado)) { //Si consulta 1 encuentra resultados
        //Consulta filtro
        $consulta1 = "SELECT * FROM OPS21 WHERE OPERACION = '$op' AND TIPO = 'OP'";

        $resultado1 = sqlsrv_query($conectar, $consulta1);
        if ($resultado1 && sqlsrv_has_rows($resultado1)) { //Si consulta filtro es correcta

            $consulta2 = "SELECT CANTIDAD FROM OPS2 WHERE OPERACION = '$op'";
            $resultado2 = sqlsrv_query($conectar, $consulta2);
            
            if (sqlsrv_has_rows($resultado2)) {
                $rows = array();
                while ($row = sqlsrv_fetch_array($resultado2, SQLSRV_FETCH_ASSOC)) {
                    $rows[] = $row;
                }
    
                return $rows;
            } else {
    
                return "Fallo en la consulta final 1";
            }

        } else {
            return "El numero no es de tipo OP";
        }
    } else {
        // Si no hay resultados en la primera consulta, ejecutamos la tercera consulta
        $consulta3 = "SELECT NRO_TABLEROS FROM OPS WHERE OPERACION = '$op'";
        $resultado3 = sqlsrv_query($conectar, $consulta3);

        // Si hay resultados en la tercera consulta, los retornamos
        if (sqlsrv_has_rows($resultado3)) {
            $rows2 = array();
            while ($row2 = sqlsrv_fetch_array($resultado3, SQLSRV_FETCH_ASSOC)) {
                $rows2[] = $row2;
            }

            return $rows2;
        } else {
            // Si no hay resultados en ninguna consulta, retornamos un error
            return "Fallo en ambas consultas principales";
        }
    }

}