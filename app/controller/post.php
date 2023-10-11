<?php
require_once("../conexion.php");

$conn = conectaDB();
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    $nombre = $data->nombre;
    $descripcion = $data->descripcion;
    $precio = $data->precio;
    $stock = $data->stock;

    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdd", $nombre, $descripcion, $precio, $stock);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Producto creado exitosamente"));
    } else {
        echo json_encode(array("message" => "Error al crear el producto: " . $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array("message" => "Método no válido"));
}

$conn->close();
?>