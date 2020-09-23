<?php include 'include/Encabezado.php' ?>
<?php include 'functions.php'?>
<?php include 'include/BaseDeDatos.php' ?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include 'include/BarraDeNavegacion.php' ?>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categoria
                    </h1>

                    <div class="col-xs-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="CategoriaTitulo">Añadir Categoria</label>
                                <input class='form-control' type="text" name="CategoriaTitulo">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="AñadirCategoria" value="Añadir Categoria">
                            </div>
                            <!---- Funciones de Categoria --->
                            <?php 
                            añadirCategoria();
                            eliminarCategoria($conexion);
                            editarCategoria($conexion);
                            ?>

                        </form>
                    </div>

                    <div class="col-xs-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Titulo</th>
                                    <th scope='col'>Operacion</th>
                                </tr>
                            <tbody>
                                <!---Tabla de Categorias--->
                                <?php
                                $Categorias = mysqli_query($conexion, 'SELECT * FROM categorias');
                                while ($fila = mysqli_fetch_assoc($Categorias)) :
                                    $ID = $fila['categoria_id'];
                                    $Titulo = $fila['categoria_titulo'];
                                ?>
                                    <tr>
                                        <td><?php echo $ID ?></td>
                                        <td><?php echo $Titulo ?></td>
                                        
                                        <?php echo "<td><a href='categorias.php?edit={$ID}'>Editar</a></td>" ?>
                                        <?php echo "<td><a href='categorias.php?delete={$ID}'>Eliminar</a></td>" ?>
                                    </tr>
                                <?php endwhile ?>

                            </tbody>
                            </thead>
                        </table>
                    </div>


                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->
                <?php include 'include/PieDePagina.php' ?>
            </div>
            <!-- /#page-wrapper -->