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
                    $titulo = $fila['categoria_titulo'];
                    echo "<li class='nav-item'><a href='#'>$titulo</a></li>";
                }
                ?>
                <li><a href="admin">Administrador</a></li>
                <li><a href="registro.php">Registro</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>