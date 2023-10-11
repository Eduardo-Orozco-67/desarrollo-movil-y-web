<?php
require_once("../conexion.php");

// Llama a la función conectaDB para obtener la conexión
$conn = conectaDB();

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        // Obtener todos los productos
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);

        $productos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }

        echo json_encode($productos);
        break;

    case "POST":
        // Crear un nuevo producto
        $data = json_decode(file_get_contents("php://input"));

        $nombre = $data->nombre;
        $descripcion = $data->descripcion;
        $precio = $data->precio;
        $stock = $data->stock;

        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdd", $nombre, $descripcion, $precio, $stock);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Producto creado exitosamente"));
        } else {
            echo json_encode(array("message" => "Error al crear el producto: " . $stmt->error));
        }
        $stmt->close(); // Cerrar la declaración después de su uso
        break;

    case "PUT":
        // Actualizar un producto existente
        $data = json_decode(file_get_contents("php://input"));

        $id = $data->id;
        $nombre = $data->nombre;
        $descripcion = $data->descripcion;
        $precio = $data->precio;
        $stock = $data->stock;

        $sql = "UPDATE productos
                SET nombre=?, descripcion=?, precio=?, stock=?
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssddi", $nombre, $descripcion, $precio, $stock, $id);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Producto actualizado exitosamente"));
        } else {
            echo json_encode(array("message" => "Error al actualizar el producto: " . $stmt->error));
        }
        $stmt->close(); // Cerrar la declaración después de su uso
        break;

    case "DELETE":
        // Eliminar un producto
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM productos WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo json_encode(array("message" => "Producto eliminado exitosamente"));
            } else {
                echo json_encode(array("message" => "Error al eliminar el producto: " . $stmt->error));
            }
            $stmt->close(); // Cerrar la declaración después de su uso
        } else {
            echo json_encode(array("message" => "Falta el ID del producto a eliminar."));
        }
        break;

    default:
        echo json_encode(array("message" => "Método no válido"));
        break;
}

$conn->close();
?>