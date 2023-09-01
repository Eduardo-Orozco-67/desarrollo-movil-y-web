function obtenerPrimeraVocalInterna(palabra) {
    const vocales = ['a', 'e', 'i', 'o', 'u'];

    for (let i = 1; i < palabra.length - 1; i++) {
        if (vocales.includes(palabra[i].toLowerCase())) {
            return palabra[i];
        }
    }

    return ''; // Si no se encuentra ninguna vocal interna
}

function generarAleatorio() {
    const letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numeros = '0123456789';

    let aleatorio = '';

    // Generar 2 letras al azar
    for (let i = 0; i < 2; i++) {
        const randomIndex = Math.floor(Math.random() * letras.length);
        aleatorio += letras[randomIndex];
    }

    // Agregar un número al azar
    const randomNumIndex = Math.floor(Math.random() * numeros.length);
    aleatorio += numeros[randomNumIndex];

    return aleatorio;
}

$(document).ready(function() {
    $('#rfc-form').submit(function(event) {
        event.preventDefault();

        const apellidoPaterno = $('#apellido-paterno').val();
        const apellidoMaterno = $('#apellido-materno').val() || 'X';
        const nombres = $('#nombre').val().split(' ');

        let primerNombre = nombres[0][0];

        if (nombres.length > 1 && (nombres[0].toLowerCase() === 'maría' || nombres[0].toLowerCase() === 'maria' || nombres[0].toLowerCase() === 'josé' || nombres[0].toLowerCase() === 'jose')) {
            primerNombre = nombres[1][0];
        }

        const fechaNacimiento = new Date($('#fecha-nacimiento').val());
        fechaNacimiento.setDate(fechaNacimiento.getDate() + 1); // Corrección del día

        const anio = fechaNacimiento.getFullYear().toString().substr(2, 2);
        const mes = (fechaNacimiento.getMonth() + 1).toString().padStart(2, '0');
        const dia = fechaNacimiento.getDate().toString().padStart(2, '0');

        const rfc = (
            apellidoPaterno[0] +
            obtenerPrimeraVocalInterna(apellidoPaterno) +
            apellidoMaterno[0] +
            primerNombre +
            anio +
            mes +
            dia +
            generarAleatorio()
        ).toUpperCase();

        $('#rfc-result').text(rfc);
    });

    $('#user-search').click(function(event) {
        event.preventDefault();

        const userId = $('#user-id').val();

        $.ajax({
            url: `https://jsonplaceholder.typicode.com/users/${userId}`,
            method: 'GET',
            success: function(data) {
                $('#user-name').text(data.name);
                $('#user-email').text(data.email);
                $('#user-result').show();
            },
            error: function() {
                $('#user-name').text('Usuario no encontrado');
                $('#user-email').text('');
                $('#user-result').show();
            }
        });
    });
});

