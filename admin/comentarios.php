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
                        Comentarios
                    </h1>
                    <!-- /.row -->
                    <?php 
                    if(isset($_GET['recurso'])){
                        $recurso = $_GET['recurso'];
                       
                        }else{
                            $recurso = '';
                        }
                    

                    switch($recurso){
                        case 'AñadirPost':
                            include 'include/AñadirPost.php';
                        break;

                        case 'EditarPost':
                            include 'include/EditarPost.php';
                        break;

                        default:
                        include 'include/VerComentarios.php';
                    break;
                }
                    ?>
                   
                </div>
                <!-- /.container-fluid -->
                <?php include 'include/PieDePagina.php' ?>
            </div>
            <!-- /#page-wrapper -->