<?php include "include/BaseDeDatos.php"; ?>
<?php include "include/Encabezado.php"; ?>



<!-- Navigation -->
<?php
if (es_metodo('post')) {
	$Usuario = $_POST['usuario'];
	$Contraseña = $_POST['contraseña'];
	if (IniciarSesion($conexion, $Usuario, $Contraseña)) {
		redireccion("/cms/admin");
	} else {
		redireccion("/cms/login");
	}
}
?>

<?php include "include/BarraDeNavegacion.php"; ?>


<!-- Page Content -->
<div class="container">

	<div class="form-gap"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">

							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Iniciar Sesion</h2>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="usuario" type="text" class="form-control" placeholder="Nombre de usuario">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="contraseña" type="password" class="form-control" placeholder="Contraseña">
										</div>
									</div>

									<div class="form-group">

										<input name="IniciarSesion" class="btn btn-lg btn-primary btn-block" value="Iniciar Sesion" type="submit">
									</div>


								</form>

							</div><!-- Body-->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<?php include "include/PieDePagina.php"; ?>

</div> <!-- /.container -->