<?php
require_once('../Modelo/Conexion.php');

function buscar_Info()
{
    if (!isset($_GET['op']) || !isset($_GET['Table']) || $_GET['op'] === '' || $_GET['Table'] === '') {
        return "Error: parámetros no válidos";
    }

    $conectar = conexion();

    // Verificamos que la conexión sea exitosa
    if ($conectar === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Recibimos el valor de OP por GET
    $OP = $_GET['op'];
    $Table = $_GET['Table'];

    // Agregamos la lógica de verificación dentro de la función
    //Consulta 1
    $consulta1 = "SELECT * FROM OPS2 WHERE OPERACION = '$OP'";
    $resultado1 = sqlsrv_query($conectar, $consulta1);

    if ($resultado1 && sqlsrv_has_rows($resultado1)) { //Si consulta 1 encuentra resultados
        //Consulta 3
        $consulta3 = "SELECT * FROM OPS21 WHERE OPERACION = '$OP' AND TIPO = 'OP'";

        $resultado3 = sqlsrv_query($conectar, $consulta3);

        if ($resultado3 && sqlsrv_has_rows($resultado3)) { //Si consulta 3 verifica que el protocolo es una OP
            //Consulta 4
            $consulta4 = "SELECT * FROM Protocolos 
            WHERE NUMEROORDEN = $OP AND dbo.PROTOCOLOS.NUMEROTABLERO = $Table";

            $resultado4 = sqlsrv_query($conectar, $consulta4);

            if ($resultado4 && sqlsrv_has_rows($resultado4)) { //Si consulta 4 es correcta

                $rows = array();
                while ($row = sqlsrv_fetch_array($resultado4, SQLSRV_FETCH_ASSOC)) {
                    $rows[] = $row;
                }

                return $rows;
            } else {
                return "La OP existe pero el tablero no"; //Retorna mensaje de error si la consulta filtro no es correcta
            }
        } else {
            return "El protocolo existe pero NO es una OP"; //Retorna mensaje de error si el protocolo existe pero no es una OP
        }
    } else { //Si consulta 1 no encuentra resultados
        //Consulta 2
        $consulta2 = "SELECT * FROM OPS WHERE OPERACION = '$OP'";
        $resultado2 = sqlsrv_query($conectar, $consulta2);

        if ($resultado2 && sqlsrv_has_rows($resultado2)) { //Si consulta 2 encuentra resultados
            //Consulta 4
            $consulta4 = "SELECT * FROM Protocolos 
            WHERE NUMEROORDEN = $OP AND dbo.PROTOCOLOS.NUMEROTABLERO = $Table";
            
            $resultado4 = sqlsrv_query($conectar, $consulta4);

            if ($resultado4 && sqlsrv_has_rows($resultado4)) { //Si consulta 4 es correcta

                $rows2 = array();
                while ($row2 = sqlsrv_fetch_array($resultado4, SQLSRV_FETCH_ASSOC)) {
                    $rows2[] = $row2;
                }

                return $rows2;
            } else {
                return "Error en la consulta de OPS"; //Retorna mensaje de error si la consulta 4 no es correcta
            }
        } else {
            return "No se contro la OP en el sistema"; //Retorna mensaje si la consulta 2 no encuentra resultados
        }
    }
}