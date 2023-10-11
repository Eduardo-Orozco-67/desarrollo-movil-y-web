<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Sistema de gestion de Prodcutos</title>
    <h1>Sistema gestor de Productos</h1>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
    <link href="css/styles.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript para manejar el API REST -->
    <script>
        $(document).ready(function () {
            // Función para obtener y mostrar la lista de productos desde el API REST
            function obtenerProductos() {
                $.ajax({
                    url: 'controller/get.php', // Ruta al API REST
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var productos = data;
                        var tablaProductos = $('#tablaProductos');
                        var tbody = tablaProductos.find('tbody'); // Obtén el cuerpo de la tabla

                        // Limpia el contenido actual de la tabla
                        tbody.empty();

                        // Itera a través de los productos y agrega filas a la tabla
                        $.each(productos, function (index, producto) {
                            var fila = '<tr>' +
                                '<td>' + producto.id + '</td>' +
                                '<td>' + producto.nombre + '</td>' +
                                '<td>' + producto.descripcion + '</td>' +
                                '<td>' + producto.precio + '</td>' +
                                '<td>' + producto.stock + '</td>' +
                                '<td><button type="button" class="btn btn-danger eliminarProducto" data-id="' + producto.id + '">Eliminar</button></td>' +
                                '<td><button type="button" class="btn btn-primary editarProducto" data-id="' + producto.id + '">Editar</button></td>' +
                                '</tr>';
                            tbody.append(fila);
                        });
                    }
                });
            }
//Manejo de eventos para guardar productos
            $('#guardarNuevoProducto').click(function () {
    var nombre = $('#nombre').val();
    var descripcion = $('#descripcion').val();
    var precio = $('#precio').val();
    var stock = $('#stock').val();

    $.ajax({
        url: 'controller/post.php', // Ruta al API REST
        method: 'POST',
        data: JSON.stringify({ nombre: nombre, descripcion: descripcion, precio: precio, stock: stock }),
        contentType: 'application/json',
        dataType: 'json',
        success: function (data) {
            obtenerProductos();
            $('#exampleModal').modal('hide');
        }
    });
});
$(document).on('click', '.eliminarProducto', function (event) {
    var idProducto = $(this).data('id');

    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        // Realiza una solicitud AJAX para enviar el ID del producto a delete.php
        $.ajax({
            url: 'controller/delete.php', // Ruta al archivo PHP que maneja la eliminación
            method: 'POST', // Utiliza el método POST para ocultar el ID en la URL
            data: { id: idProducto },
            success: function (data) {
                // Procesa la respuesta de delete.php
                console.log(data);

                // Si la eliminación fue exitosa, recarga la página
                if (data === "Producto eliminado con éxito") {
                    location.reload();
                } else {
                    // Maneja posibles errores aquí, por ejemplo, mostrando un mensaje de error
                    console.log('Error al eliminar el producto: ' + data);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error al eliminar el producto: ' + errorThrown);
            }
        });
    }
});


            // Obtener y mostrar la lista de productos al cargar la página
            obtenerProductos();
        });
    </script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?></a>
        <a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
    </div>
</nav>
<center>
    <br><br>

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nuevo Producto
    </button>

    <br><br>
    <div class="table-container">
        <table class='table' style='width: 100%;' id="tablaProductos">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos de productos se llenarán aquí mediante JavaScript -->
            </tbody>
        </table>
    </div>

    <br><br>
    <!-- Modal Ventana de Nuevo Producto -->
    <!-- Modal Ventana de Nuevo Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="3" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for "stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" id="stock" required autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="guardarNuevoProducto">Guardar</button>
            </div>
        </div>
    </div>
</div>
</center>

<!-- Footer -->
<footer class="footer bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white"><b> Examen Practico Desarrollo de aplicaciones web y móviles [ Jose Eduardo Orozco Cardenas B200077 y Samuel Sanchez Guzman B200079] </b></p>
    </div>
</footer>

</body>
</html>
