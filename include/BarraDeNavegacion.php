<!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Mi blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                include 'include/BaseDeDatos.php';
                $resultado = mysqli_query($conexion, 'SELECT * FROM categorias');
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $id = $fila['categoria_id'];
                    $titulo = $fila['categoria_titulo'];
                    if (isset($_GET['categoria_id'])) {
                        $id_categoria = $_GET['categoria_id'];
                        if ($id == $_GET['categoria_id']) {
                            echo " <li class='active nav-item'><a href='categoria.php?id=$id'>$titulo</a></li>";
                        } else {
                            echo " <li  class='nav-item'><a href='categoria.php?id=$id'>$titulo</a></li>";
                        }
                    } else {
                        echo " <li class='nav-item'><a href='categoria.php?id=$id'>$titulo</a></li>";
                    }
                }
                ?>

                <?php if (iniciado()) : ?>
                    <li><a href="admin/index.php">Administrador</a></li>
                <?php else :  ?>
                    <li><a href="login.php">Iniciar Sesion</a></li>
                <?php endif ?>


                <li><a href="registro.php">Registro</a></li>
                <li><a href="contacto.php">Contactos</a></li>


            </ul>

            <ul class='nav navbar-right top-nav'>
                <ul class="nav navbar-nav">
                    <li>
                        <a href='include/CerrarSesion.php'><i class='fa fa-fw fa-power-off'></i>
                            <?php
                            if (isset($_SESSION['usuario'])) {
                                echo 'Cerrar Sesion';
                            }
                            ?>
                        </a>
                    </li>
                </ul>
            </ul>



        </div>
        <!-- /.navbar-collapse -->

    </div>
    <!-- /.container -->
</nav>