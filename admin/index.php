<?php include 'include/Encabezado.php' ?>
<?php include 'include/BaseDeDatos.php' ?>
<?php include 'functions.php' ?>;
<div id="wrapper">

    <!-- Navigation -->
    <?php include 'include/BarraDeNavegacion.php' ?>
    <?php
    $solicitudPost = mysqli_query($conexion, "SELECT * FROM post");
    $solicitudComentarios = mysqli_query($conexion, "SELECT * FROM comentarios");
    $solicitudUsuarios = mysqli_query($conexion, "SELECT * FROM usuarios");
    $solicitudCategorias = mysqli_query($conexion, "SELECT * FROM categorias");

    $Post = mysqli_num_rows($solicitudPost);
    $Comentarios = mysqli_num_rows($solicitudComentarios);
    $Usuarios = mysqli_num_rows($solicitudUsuarios);
    $Categorias = mysqli_num_rows($solicitudCategorias);
    ?>

    <div id="page-wrapper">

    <?php 
   
    ?>

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Bienvenido
                        <small><?php
                                echo $_SESSION['usuario'];
                                ?></small>
                    </h1>
                    <h2>En linea <?php echo  usuariosEnLina($conexion); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $Post ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $Comentarios ?></div>
                                    <div>Comentarios</div>
                                </div>
                            </div>
                        </div>
                        <a href="comentarios.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $Usuarios ?></div>
                                    <div> Usuarios</div>
                                </div>
                            </div>
                        </div>
                        <a href="usuarios.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $Categorias ?></div>
                                    <div>Categorias</div>
                                </div>
                            </div>
                        </div>
                        <a href="categorias.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
            <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Datos', 'Cantidad'],
                            ['Post', <?php echo $Post ?>],
                            ['Comentarios', <?php echo $Comentarios ?>],
                            ['Usuarios', <?php echo $Usuarios ?>],
                            ['Categorias', <?php echo $Categorias ?>],
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
            </div>

        </div>
        <!-- /.container-fluid -->
        <?php include 'include/PieDePagina.php' ?>
    </div>
    <!-- /#page-wrapper -->