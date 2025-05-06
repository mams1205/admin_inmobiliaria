<?php
include('conexion_bd.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['name'];
    $apellido = $_POST['apellido'];
    $genero = $_POST['genero'];
    $edad = $_POST['edad'];
    $estudios = $_POST['estudios'];
    $ingles = $_POST['ingles'];
    $extranjero = $_POST['extranjero'];
    $vives = $_POST['vives'];
    $mail = $_POST['mail'];
    $celular = $_POST['celular'];
    $computadora = $_POST['computadora'];
    $carro = $_POST['carro'];
    $metodo_contacto = $_POST['metodo_contacto'];
    $comisiones = $_POST['comisiones'];
    $justificacion = $_POST['justificacion'];

    if (empty($nombre) || empty($apellido) || empty($genero) || empty($edad) || empty($estudios) || empty($ingles) || empty($extranjero) || empty($vives) || empty($mail)
    || empty($celular) || empty($carro) || empty($metodo_contacto) || empty($comisiones || empty($justificacion))) {
        echo "error"; // Si falta algún campo
        exit;
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO formulario_bolsa_trabajo (nombre, apellidos, genero, edad, estudios,
                                                  ingles, extranjero, vive, mail,
                                                  celular, computadora_personal, carro_personal, metodo_contacto,
                                                  comisiones_enterado,justificacion) 
            VALUES ('$nombre', '$apellido', '$genero', '$edad',
                    '$estudios', '$ingles', '$extranjero', '$vives',
                    '$mail', '$celular', '$computadora', '$carro',
                    '$metodo_contacto', '$comisiones', '$justificacion')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)){
        echo trim("success"); // Si la inserción es exitosa
        } else {
            echo "db-error"; // Si hubo un error en la ejecución de la consulta
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>