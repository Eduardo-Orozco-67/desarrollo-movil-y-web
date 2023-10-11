$(document).ready(function(){
    $('#login').on('click', function(){
        login();
    });
});

function login(){
    var loginUsername = $('#loginUsername').val();
    var loginPassword = $('#loginPassword').val();

    $.ajax({
        url: 'controller/validar.php',
        method: 'POST',
        data: {
            loginUsername: loginUsername,
            loginPassword: loginPassword,
        },
        success: function(data){
            var jsonData = JSON.parse(data);

            if (jsonData.success == "1") {
                window.location = 'dashboard.php'; // Redirige a la página de inicio después de iniciar sesión correctamente.
            } else {
                var msg_alerta = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    'Nombre de usuario y/o contraseña incorrectos</div>';

                $('#loginMessage').html(msg_alerta);
            }
        }
    });
}