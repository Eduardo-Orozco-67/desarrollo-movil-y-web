<?php
session_start();

if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Conectar a la base de datos
    require_once("../conexion.php"); // Asegúrate de que la ruta sea correcta

    $link = conectaDB();

    // Prevenir inyección SQL
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    // Consulta SQL para verificar las credenciales en la tabla de usuarios
    $query = "SELECT * FROM tb_usuarios WHERE NomUser='$username' AND Passwd='$password'";

    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 1) {
        // Usuario y contraseña válidos, iniciar sesión
        $_SESSION['login'] = "true";
        $_SESSION['nomusuario'] = $username;
        echo json_encode(array('success' => 1));
    } else {
        // Usuario o contraseña incorrectos
        echo json_encode(array('success' => 0));
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($link);
} else {
    echo json_encode(array('success' => 0));
}
?>
