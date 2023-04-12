<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../Vistas/Login.php");
    exit();
}
?>

<?php require_once('../Includes/Header.php'); ?>


<div class="container">
    <br><br>
    <h2 class="text-center">Busqueda de operaciones</h2>
    <br>
    <form>
        <div class="row align-items-center">
            <div class="col">
                <label for="op" class="form-label"># OP:</label>
                <input type="number" class="form-control" id="op" name="op" autocomplete="off"
                    onkeyup="handleKeyPress(event)">
            </div>
            <div class="col">
                <label for="dropdown-resultados" class="form-label">Tablero #:</label>
                <select class="form-select" id="dropdown-resultados" name="dropdown-resultados"
                    onchange="buscarLista();"></select>
            </div>
            &nbsp;
            <div class="col">
                <label class="form-label"></label>
                <button type="button" class="btn btn-dark btn-block" onclick="buscarTablero();">Buscar</button>
            </div>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <div class="col-md-3">
                <label for="username" class="form-label">Responsable:</label>
                <input type="text" class="form-control" id="username" name="username" readonly
                    value="<?php echo $_SESSION['user']; ?>">
            </div>
        </div>
    </form>
    <br>
    <div class="col-md-12">
        <br>
        <div id="boton-container" style="text-align: right;">
            <!-- <button type="button" class="btn btn-success btn-block sl-auto" id="guardar-btn">Guardar</button> -->
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cod</th>
                    <th>Descripción</th>
                    <th>Referencia</th>
                    <th>Cantidad instalada</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody id="tabla-resultados" name="tabla-resultados">
            </tbody>
        </table>
        <br><br>
    </div>
</div>

<?php require_once('../Includes/Footer.php'); ?>