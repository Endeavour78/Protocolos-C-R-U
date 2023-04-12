<!-- PhP Version (7.4.28) -->
<!-- Verifica que las extensiones necesarias para usar SQL SERVER esten habilitadas -->

<?php
// if (extension_loaded('sqlsrv')) {
//     echo 'La extensión sqlsrv está habilitada.';
// } else {
//     echo 'La extensión sqlsrv no está habilitada.';
// }
?>

<?php
// if (extension_loaded('pdo_sqlsrv')) {
//     echo 'La extensión pdo_sqlsrv está habilitada.';
// } else {
//     echo 'La extensión pdo_sqlsrv no está habilitada.';
// }
?>
<!-- ------------------------------------------------------------------------------------------- -->

<!-- Informacion general de la version y demás cosas de interes de PhP instalado -->
<?php
    phpinfo() 
?>

<!-- Carga todas las extensiones instaladas (por si no se han cargado correctamente) -->
<?php 
    // php_ini_loaded_file() 
?>
