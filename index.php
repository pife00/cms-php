<?php include 'include/Encabezado.php' ?>
<?php include 'include/BarraDeNavegacion.php' ?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            include 'include/BaseDeDatos.php';
            
            if(isset($_GET['pagina'])){
                $pagina = $_GET['pagina']; 
            }else{
                $pagina = '';
            }
            if($pagina == 1 || $pagina==''){
                $PaginaReal = 0;
            }else{
                $PaginaReal = ($pagina * 5) - 5;
            }


            $NumeroPost = mysqli_query($conexion, "SELECT * FROM post ");
            $NumeroPost = mysqli_num_rows($NumeroPost);
            $Paginas = ceil($NumeroPost / 10);

            $Solicitud = "SELECT * FROM post WHERE post_estado ='Aprobado' ORDER BY post_id DESC LIMIT $PaginaReal,5";
            $TodosLosPost = mysqli_query($conexion, $Solicitud);
            while ($fila = mysqli_fetch_assoc($TodosLosPost)) :
                $PostID =  $fila['post_id'];
                $PostTitulo = $fila['post_titulo'];
                $PostAutor = $fila['post_autor'];
                $PostFecha = $fila['post_fecha'];
                $PostImagen = $fila['post_imagen'];
                $PostContenidoEnviar = $fila['post_contenido'];
                $PostContenido = substr($fila['post_contenido'], 0, 100);
            ?>
                <!-- First Blog Post -->
                <?php
                echo
                    "<h2><a href='./post/$PostID'>$PostTitulo</a></h2>";

                ?>
                <p class="lead">
                    Por <a href=<?php echo "filtro_autor.php?post_autor=$PostAutor" ?>><?php echo $PostAutor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $PostFecha ?></p>
                <hr>
                <a href='./post.php?post_id=<?php echo $PostID ?>'>
                    <img class="img-responsive" src="imagenes/<?php echo $PostImagen ?>" alt="">
                </a>

                <hr>
                <p><?php echo $PostContenido ?></p>
                <?php
                echo "
                 <a class='btn btn-primary' href='./post.php?post_id=$PostID'>Leer Mas 
                 <span class='glyphicon glyphicon-chevron-right'></span></a>
                 "
                ?>
                <hr>
            <?php endwhile ?>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Antiguos</a>
                </li>
                <li class="next">
                    <a href="#">Nuevos &rarr;</a>
                </li>
            </ul>

        </div>
        <?php include 'include/BarraLateral.php' ?>
        <!-- Side Widget Well -->
        <div class="well">
            <h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
        </div>

    </div>

</div>
<!-- /.row -->
<hr>
<ul class="pagination">
    <?php
    for ($i = 1; $i <= $Paginas; $i++) {
        if($i == $pagina){
            echo "<li class='page-item active'><a href='index.php?pagina=$i' class='page-link'>$i</a></li>";
        }else{
            echo "<li class='page-item'><a href='index.php?pagina=$i' class='page-link'>$i</a></li>";
        }
    }
    ?>

</ul>
<?php include 'include/PieDePagina.php' ?>


</html>