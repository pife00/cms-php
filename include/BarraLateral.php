 <!-- Blog Sidebar Widgets Column -->
 <?php
    if (isset($_SESSION['usuario'])) {
        $Style = "style='display:none;'";
    } else {
        $Style = "style='display:block;'";
    }
    ?>
 <div class="col-md-4">
     <!-- Blog Search Well -->
     <div class="well">
         <h4>Blog Search</h4>
         <form action="busqueda.php" method='post'>
             <div class="input-group">
                 <input name="BarraDeBusqueda" type="text" class="form-control">
                 <span class="input-group-btn">
                     <button name="BusquedaBlog" class="btn btn-default" type="submit">
                         <span class="glyphicon glyphicon-search"></span>
                     </button>
                 </span>
             </div>
         </form>
         <!-- /.input-group -->
     </div>

     <div class="well" <?php echo $Style ?>>
         <h4>Iniciar Sesion</h4>
         <form action="include/IniciarSesion.php" method='post'>
             <div class="input-group">
                 <label for="">Usuario</label>
                 <input name="usuario" type="text" class="form-control">
             </div>
             <div class="input-group">
                 <label for="">Contraseña</label>
                 <input name="contraseña" type="password" class="form-control">
             </div>
             <p></p>
             <button type="submit" name="UsuarioSesion" class="btn btn-primary">Enviar</button>
         </form>
         <!-- /.input-group -->
     </div>

     <!-- Blog Categories Well -->
     <div class="well">
         <h4>Categorias</h4>
         <div class="row">
             <div class="col-lg-6">
                 <?php
                    include 'include/BaseDeDatos.php';
                    $resultado = mysqli_query($conexion, 'SELECT * FROM categorias');
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $ID = $fila['categoria_id'];
                        $titulo = $fila['categoria_titulo'];
                        echo "<li class='nav-item'><a href='./categoria.php?categoria_id=$ID'>$titulo</a></li>";
                    }
                    ?>
             </div>
             <!-- /.col-lg-6 -->
         </div>
         <!-- /.row -->
     </div>