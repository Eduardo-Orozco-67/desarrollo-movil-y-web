<?php

if($_POST['txtuser'] == "admin" && $_POST['txtpass'] == "unach"){
    session_start();
    $_SESSION['login'] = "true";
    $_SESSION['nomusuario'] = $_POST['txtuser'];
    header("location: menu.php");
}
else{
    header("location: index.php");
}

?>