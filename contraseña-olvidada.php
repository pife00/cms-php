<?php include "include/BaseDeDatos.php"; ?>
<?php include "include/Encabezado.php"; ?>
<?php include 'include/BarraDeNavegacion.php' ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'clases/configuacion.php';
$correoEstado = false;

?>

<?php
if (isset($_POST['recuperar-contraseña'])) {
    $correo = $_POST['correo'];
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));
    if (correo_existe($conexion, $correo)) {
        $stmt = mysqli_prepare($conexion, "UPDATE usuarios SET token='$token' WHERE usuario_correo =?");
        mysqli_stmt_bind_param($stmt, "s", $correo);
        if (!$r = mysqli_stmt_execute($stmt)) {
            echo 'Eror consulta';
        }
        mysqli_stmt_close($stmt);
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = SMTP_HOST;                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = USUARIO;                     // SMTP username
            $mail->Password   = CLAVE;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = PUERTO;
            $mail->CharSet = 'UTF-8';   //Acepta caracteres UTF-8
            $mail->SMTPDebug = 0;       // Desactiva el debbuger molesto                      

            //Recipients
            $mail->setFrom('pife00@gmail.com', 'Mailer');
            $mail->addAddress('pife001@gmail.com', 'Felipe');     // Add a recipient
            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Recuperar Contraseña";
            $mail->Body    = "presione <a href='http://localhost:80/cms/resetear-contraseña.php?correo=$correo&token=$token'>
            http://localhost:80/cms/resetear-contraseña.php?correo=$correo&token=$token</a>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->send()) {
                $correoEstado = true;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
    }
}
?>

<?php include 'include/BarraDeNavegacion.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <?php if (!$correoEstado) : ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">¿Olvido su Contraseña?</h2>
                                <p>Puedes reiniciarla aqui.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="correo" placeholder="direccion de correo" class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recuperar-contraseña" class="btn btn-lg btn-primary btn-block" value="Solicitar Contraseña" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                            <?php else : ?>
                                <h2>Peticion enviada</h2>
                                <p>Por favor revise su correo electronico</p>
                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "include/PieDePagina.php"; ?>

</div> <!-- /.container -->