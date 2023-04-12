<?php require_once('../Includes/Header.php'); ?>
<?php
session_start();

// Comprobar si hay un mensaje de error en la variable de sesión
if (isset($_SESSION['mensajeError'])) {
    $mensajeError = $_SESSION['mensajeError'];
    // Borrar la variable de sesión para que no se muestre más de una vez
    unset($_SESSION['mensajeError']);
} else {
    $mensajeError = null;
}
?>

<!-- Mostrar el mensaje de error si existe -->
<?php if ($mensajeError): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error al iniciar sesión',
            text: '<?php echo $mensajeError; ?>'
        });
    </script>
<?php endif; ?>
<section class="vh-5">
    <div class="container-fluid mt-3">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-6 text-black">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="../Controlador/LoginController.php" method="post" style="" class="mx-auto">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex flex-column align-items-center">
                                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicio de sesión</h3>
                                </div>
                            </div>
                            <div class="form-outline mb-2">
                                <input type="text" class="form-control form-control-lg" id="username" name="username"
                                    autocomplete="off" placeholder="Usuario" required />
                                <label class="form-label" for="usuario">Usuario</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" class="form-control form-control-lg" id="password"
                                    name="password" autocomplete="off" placeholder="Contraseña" required />
                                <label class="form-label" for="contrasena">Contraseña</label>
                                <span class="toggle-password" id="toggle-password"
                                    onclick="togglePasswordVisibility()"><i class="fa fa-eye"></i></span>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="pt-1 mb-4">
                                        <button type="submit" name="submit"
                                            class="btn btn-success btn-block rounded-pill">Iniciar sesión</button>
                                    </div>
                                    <!-- <p class="small mb-1 pb-lg-2"><a class="text-muted"
                                            onclick="contrasenaOlvidada()">¿Olvidaste tus datos?</a></p> -->

                                    <p class="small mb-1 pb-lg-2"><a class="text-muted"
                                            onclick="credenciales()">Toca aqui para obtener las credenciales de sesion</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- </body>

<script src="../Assets/js/JsPropio.js"></script>
<script src="../Assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

</html> -->
<?php require_once('../Includes/Footer.php'); ?>