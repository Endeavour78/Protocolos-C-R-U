<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN y CSS general -->
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets/css/cssPropio.css" rel="stylesheet">

    <!-- SweetAlert2 CDN -->
    <link href="../Assets/css/sweetalert2.min.css" rel="stylesheet">


    <!-- link de referencia para iconos de font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Icono de la pagina -->
    <link rel="icon" type="image/png" sizes="16x16" href="../Assets/img/example.png">

    <!-- scrips  -->
    <script src="../Assets/js/sweetalert2.all.min.js"></script>
    <script src="../Assets/js/JsPropio.js"></script>
    <script src="../Assets/js/jquery.min.js"></script>
    <script src="../Assets/js/bootstrap.min.js"></script>

    <title>Busqueda de operaciones</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="navbar-header mr-auto">
                    <a class="navbar-brand" href="#"><img src="../Assets/img/example.png"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['logged_in'])): ?>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" href="../Controlador/LogoutController.php">Cerrar
                                    sesión</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>