<?php
// Establecer el encabezado para recibir JSON
header('Content-Type: application/json');

// Obtener el contenido del cuerpo de la solicitud
$inputJSON = file_get_contents('php://input');

// Decodificar el JSON recibido
$data = json_decode($inputJSON, true);

if ($data) {
    // Acceder a las variables
    $imagenesSeleccionadas = $data['imagenesSeleccionadas'];
    $ubiExacta = $data['ubiExacta'];
    $direccionCompleta = $data['direccionCompleta'];
    $infoContacto = $data['infoContacto'];
    $descripcion = $data['descripcion'];

    // Imprimir la respuesta para probar
    echo json_encode([
        'success' => true,
        'message' => 'Datos recibidos correctamente',
        'data' => $data
    ]);
} else {
    // Si no se envió JSON válido
    echo json_encode([
        'success' => false,
        'message' => 'No se recibieron datos válidos'
    ]);
}
?>
