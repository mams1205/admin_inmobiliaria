<?php
include('conexion_bd.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['name'];
    $mail = $_POST['email'];
    $asunto = $_POST['subject'];
    $mensaje = $_POST['message'];
    // Validar datos (por ejemplo, validar correo electrónico)
    if (empty($nombre) || empty($mail) || empty($asunto) || empty($mensaje)) {
        echo "error"; // Si falta algún campo
        exit;
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO formulario_contacto (nombre, email, asunto, mensaje) 
            VALUES ('$nombre', '$mail', '$asunto', '$mensaje')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)){
        echo "success"; // Si la inserción es exitosa
        } else {
            echo "db-error"; // Si hubo un error en la ejecución de la consulta
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>