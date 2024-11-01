<?php
// Incluir la conexión a la base de datos
include '../conexionMysql.php';

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error al conectar con el servidor: " . $conexion->connect_error);
}

// Obtener el ID del cliente desde la solicitud JSON
$data = json_decode(file_get_contents("php://input"), true);
$idcliente = isset($data['idcliente']) ? $data['idcliente'] : null;

if ($idcliente && is_numeric($idcliente)) {
    // Preparar la consulta para actualizar el estado del cliente a inactivo
    $sql = "UPDATE clientes SET estado = 0 WHERE idcliente = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $idcliente);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Verificar si se actualizó alguna fila
            if ($stmt->affected_rows > 0) {
                echo json_encode(["message" => "Cliente eliminado lógicamente."]);
            } else {
                echo json_encode(["message" => "No se encontró el cliente."]);
            }
        } else {
            echo json_encode(["message" => "Error al ejecutar la consulta: " . $stmt->error]);
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        echo json_encode(["message" => "Error al preparar la consulta: " . $conexion->error]);
    }
} else {
    echo json_encode(["message" => "ID de cliente no válido."]);
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
