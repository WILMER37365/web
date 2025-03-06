<?php

session_start();
if (isset($_SESSION['sesion_email'])) {
    //echo "EL USUARIO PASSO POR EL LOGIN";
    $email_sesion = $_SESSION['sesion_email'];
    $query_session=$pdo->prepare("SELECT * FROM usuarios AS usu
         INNER JOIN roles as rol ON rol.id_rol=usu.rol_id
         WHERE usu.email= '$email_sesion' AND (estado='1' OR estado='0') ");
    $query_session->execute();
    $datos_sesion_usuarios=$query_session->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datos_sesion_usuarios as $datos_sesion_usuario) {
       $nombre_sesion_usuario=$datos_sesion_usuario['nombres'];
       $id_rol_sesion_usuario=$datos_sesion_usuario['rol_id'];
       $rol_sesion_usuario=$datos_sesion_usuario['nombre_rol'];
       $apellido_sesion_usuario=$datos_sesion_usuario['apellidos'];
       $perfil_sesion_usuario=$datos_sesion_usuario['perfil'];
       $email_sesion_usuario=$datos_sesion_usuario['email'];
       $id_usuario=$datos_sesion_usuario['id_usuario'];
       $alias=$datos_sesion_usuario['alias'];
    }


    $url=$_SERVER['PHP_SELF'];
    $conta=strlen($url);
    $rest = substr($url,15,$conta);

    $sql_roles_permisos = "SELECT * FROM roles_permisos as rolper
         INNER JOIN permisos as per ON per.id_permiso = rolper.permiso_id
         INNER JOIN roles as rol ON rol.id_rol = rolper.rol_id
        WHERE rolper.estado_roles_permiso= '1' ";

    $query_roles_permisos = $pdo->prepare($sql_roles_permisos);
    $query_roles_permisos->execute();
    $roles_permisos = $query_roles_permisos->fetchAll(PDO::FETCH_ASSOC);
    $contador_de_permisos=0;
    foreach ($roles_permisos as $roles_permiso){

        if($id_rol_sesion_usuario==$roles_permiso['rol_id']){


            if ($rest == $roles_permiso['url']) {
                //echo "Permitido";
                $contador_de_permisos=$contador_de_permisos+1;
            }else{
                //echo "No Permitido";
            }
        }
    }

    if ($contador_de_permisos>0){
        //echo "Permitido";
    }else{
        //echo "No Permitido";
        header("location:".APP_URL."/admin/no_autorizado.php");
    }

}else{
    //echo "EL USUARIO NO PASO POR LOGIN";
    header("location:".APP_URL."/login");
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo APP_NAME;?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo APP_URL;?>/public/dist/css/adminlte.min.css">
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- BOOTSTRAP ICONOS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- DATATABLES PARA LAS TABLAS-->
    <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- IcoFinder (Usualmente es un catálogo, pero puedes usar sus íconos con FontAwesome o Material Icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.69/vfs_fonts.js"></script>
    <!-- EXCEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>




</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?php echo APP_URL;?>/admin" class="nav-link"><?php echo APP_NAME;?></a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">


            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo APP_URL;?>/admin" class="brand-link">
            <img src="<?php echo APP_URL;?>/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SIS HECHO EN BOLIVIA</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo APP_URL;?>/public/images/usuarios/<?php echo $perfil_sesion_usuario; ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="<?php echo APP_URL; ?>/admin/usuarios/edit_personal.php?id=<?php echo $id_usuario; ?>" type="button" class="d-block"><?php echo $alias;?></a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <?php
                    if (($rol_sesion_usuario=="ADMINISTRADOR")){ ?>
                    <!-- Sidebar ROLES-->
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas"><i class="fa-solid fa-user-shield"></i></i>
                            <p>
                                Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo APP_URL;?>/admin/roles" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de Roles</p>
                                </a>
                            </li>

                        </ul>


                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo APP_URL;?>/admin/roles/permisos.php" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permisos</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <?php
                    }
                    ?>

                    <?php

                    if (($rol_sesion_usuario=="ADMINISTRADOR")){ ?>
                        <!-- Sidebar USUARIOS-->
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="fa-solid fa-users"></i></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo APP_URL;?>/admin/usuarios" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Roles</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <?php
                    }
                    ?>



                    <?php

                    if (($rol_sesion_usuario=="ADMINISTRADOR") | ($rol_sesion_usuario=="RESPONSABLE FARMACÉUTICA")){ ?>
                        <!-- Sidebar FORMAS FARMACÉUTICAS-->
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="fa-solid fa-flask-vial"></i></i>
                                <p>
                                    Formas Farmacéuticas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo APP_URL;?>/admin/formasfarmaceuticas" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Formas</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <?php
                    }
                    ?>



                    <?php

                    if (($rol_sesion_usuario=="ADMINISTRADOR") | ($rol_sesion_usuario=="RESPONSABLE FARMACÉUTICA")){ ?>
                        <!-- Sidebar MEDALLAS-->
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="fa-solid fa-medal"></i></i>
                                <p>
                                    Medallas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo APP_URL;?>/admin/medallas" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Medallas</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <?php
                    }
                    ?>



                    <?php

                    if (($rol_sesion_usuario=="ADMINISTRADOR") | ($rol_sesion_usuario=="RESPONSABLE FARMACÉUTICA")
                        | ($rol_sesion_usuario=="RECURSOS HUMANOS") | ($rol_sesion_usuario=="REGENCIA FARMACÉUTICA")
                        | ($rol_sesion_usuario=="VENTAS") | ($rol_sesion_usuario=="GERENTE REGIONAL")| ($rol_sesion_usuario=="DIRECCION TECNICA")){ ?>
                        <!-- Sidebar CERTIFICADOS-->
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas"><i class="fa-regular fa-file-pdf"></i></i>
                                <p>
                                    Certificados HB
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo APP_URL;?>/admin/certificados" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Certificados</p>
                                    </a>
                                </li>

                            </ul>


                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo APP_URL;?>/admin/certificados/importar" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Certificados por Lotes</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <?php
                    }
                    ?>





                    <li class="nav-item">
                        <a href="<?php echo APP_URL;?>/login/logout.php" class="nav-link" style="background-color: #bf0f0f">
                            <i class="nav-icon fas"><i class="bi bi-x-octagon"></i></i>
                            <p>
                                Cerrar Sesión
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>