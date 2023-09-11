$(document).ready(function () {
    // Array para almacenar los productos registrados
    const productosRegistrados = [];

    // Función para cargar el formulario de registro de productos
    function cargarFormularioRegistro() {
        $.ajax({
            url: 'formulario_registro.html', // Archivo HTML del formulario de registro
            success: function (data) {
                $('#content').html(data);

                // Agregar evento de envío del formulario
                $('#registro-producto-form').submit(function (e) {
                    e.preventDefault(); // Evitar que el formulario se envíe por defecto

                    // Recopilar datos del formulario
                    const nombreProducto = $('#nombre-producto').val();
                    const descripcion = $('#descripcion').val();
                    const precio = $('#precio').val();
                    const categoria = $('#categoria').val();

                    // Crear un objeto de producto
                    const nuevoProducto = {
                        nombre: nombreProducto,
                        descripcion: descripcion,
                        precio: parseFloat(precio),
                        categoria: categoria
                    };

                    // Agregar el producto al array de productos registrados
                    productosRegistrados.push(nuevoProducto);

                    // Limpiar el formulario
                    $('#nombre-producto').val('');
                    $('#descripcion').val('');
                    $('#precio').val('');
                    $('#categoria').val('');

                    // Mostrar un mensaje de éxito
                    $('#mensaje-exito').html('<p>Producto registrado con éxito.</p>');
                });
            },
            error: function () {
                $('#content').html('<p>Error al cargar el formulario.</p>');
            }
        });
    }

    // Cargar el formulario de registro cuando se inicie la SPA
    cargarFormularioRegistro();
});
