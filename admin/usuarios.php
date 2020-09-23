<?php include 'include/Encabezado.php' ?>
<?php include 'include/BaseDeDatos.php' ?>
<?php include 'functions.php' ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'include/BarraDeNavegacion.php' ?>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Usuarios
                    </h1>
                    <!-- /.row -->
                    <?php 
                    if(isset($_GET['recurso'])){
                        $recurso = $_GET['recurso'];
                       
                        }else{
                            $recurso = '';
                        }
                    

                    switch($recurso){
                        case 'AñadirUsuario':
                            include 'include/AñadirUsuario.php';
                        break;

                        case 'EditarUsuario':
                            include 'include/EditarUsuario.php';
                        break;

                        default:
                        include 'include/VerUsuarios.php';
                    break;
                }
                    ?>
                   
                </div>
                <!-- /.container-fluid -->
                <?php include 'include/PieDePagina.php' ?>
            </div>
            <!-- /#page-wrapper -->