<?php
session_start();
include('../app/config.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo APP_NAME; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/public/dist/css/adminlte.min.css">
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Add some custom styles -->
    <!-- Add some custom styles -->
    <style>
        body {
            background: url('<?php echo APP_URL; ?>/public/images/logo2.png') no-repeat center center fixed;
            background-size: 60%; /* Reduce el tamaño de la imagen al 20% de su tamaño original */
            background-position: center center; /* Asegura que la imagen se mantenga centrada */
            background-attachment: fixed;
            font-family: 'Source Sans Pro', sans-serif;
            height: 100vh; /* Asegura que la imagen ocupe toda la altura de la pantalla */
            margin: 0; /* Elimina márgenes en el body */
        }

        /* Para añadir opacidad a la imagen de fondo */
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.6); /* Ajusta la opacidad aquí */
            z-index: -1; /* Asegúrate de que quede por detrás del contenido */
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: white;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }

        .login-logo h3 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .input-group input {
            border-radius: 25px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .input-group .input-group-text {
            border-radius: 25px;
            background-color: #f7f7f7;
        }

        .input-group.mb-3 {
            margin-bottom: 20px;
        }

        .btn-primary {
            border-radius: 25px;
            padding: 10px 20px;
            background-color: #2196F3;
            border: none;
            transition: all 0.9s ease;
        }

        .btn-primary:hover {
            background-color: #1976D2;
            transform: scale(1.05);
        }

        .login-box img {
            width: 300px;
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <center>
        <img src="https://img.freepik.com/vector-gratis/concepto-busqueda-archivos-pagina-destino_52683-18202.jpg?semt=ais_hybrid"
             width="300px" alt="">
    </center>
    <br>
    <div class="login-logo">
        <h3 href=""><b><?php echo APP_NAME; ?></b></h3>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Inicio de Sesión</p>

            <form action="controller_login.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
                </div>
            </form>

            <!-- PARA LOS MENSAJES DE ALERTA COMO SWEET ALERT -->
            <?php

            if (isset($_SESSION['mensaje'])) {
                $mensaje = $_SESSION['mensaje'];
                ?>
                <script>
                    Swal.fire({
                        position: "top-end", // Posición de la alerta en la parte superior derecha
                        icon: "error",
                        title: "<?php echo $mensaje; ?>",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
                <?php
                session_destroy();
            }
            ?>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo APP_URL; ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo APP_URL; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo APP_URL; ?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>


