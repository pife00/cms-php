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
                        Post 
                    </h1>
                    <div style="text-align:right;">
                    <form style="display: contents;" action="posts.php" method="post">
                            <select style="
                                margin-left:1em;
                                width: 25%;
                                
                                height: 34px;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                                " name="post_filtro" class="custom-select" id="">
                                <option selected value="Todos">Todos</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Denegado">Denegado</option>
                            </select>
                            <input value="Aplicar" type="submit" name="Filtro" class="btn btn-primary">
                        </form>
                </div>
                    <!-- /.row -->


                    <?php
                    if (isset($_GET['recurso'])) {
                        $recurso = $_GET['recurso'];
                    } else {
                        $recurso = '';
                    }


                    switch ($recurso) {
                        case 'AñadirPost':
                            include 'include/AñadirPost.php';
                            break;

                        case 'EditarPost':
                            include 'include/EditarPost.php';
                            break;

                        default:
                            include 'include/VerPost.php';
                            break;
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->
                <?php include 'include/PieDePagina.php' ?>
            </div>
            <!-- /#page-wrapper -->