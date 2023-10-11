<?php
require_once("../conexion.php");

$conn = conectaDB();
header("Content-Type: application/json");

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$productos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

echo json_encode($productos);

$conn->close();
?>