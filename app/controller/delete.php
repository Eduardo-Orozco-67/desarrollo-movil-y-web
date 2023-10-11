<?php
include('../conexion.php');
$con = conectaDB();

// Verifica si se recibió el ID del producto a eliminar
if (isset($_POST['id'])) {
    $idProducto = $_POST['id'];

    // Consulta SQL para eliminar el producto por su ID
    $query = "DELETE FROM productos WHERE id = $idProducto";

    // Ejecuta la consulta
    if (mysqli_query($con, $query)) {
        // Si la eliminación se realizó con éxito, puedes devolver un mensaje de éxito
        echo "Producto eliminado con éxito";
    } else {
        // En caso de error, muestra un mensaje de error
        echo "Error al eliminar el producto: " . mysqli_error($con);
    }
} else {
    // Si no se proporcionó el ID del producto, muestra un mensaje de error
    echo "ID de producto no proporcionado";
}

// Cierra la conexión a la base de datos
mysqli_close($con);
?>
