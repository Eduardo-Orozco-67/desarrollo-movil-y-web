<?php
function conectaDB() 
{ 
  	$host = 'localhost'; 
	$user = 'id21195859_root';
	$pass = 'Ch12345?';

   if (!( $link = @mysqli_connect($host, $user, $pass)) )
   {
      echo "Error al realizar la conexión a la base de datos.";
      exit();
   }

   if (!mysqli_select_db($link, "id21195859_bd")) 
   { 
      echo "Error al seleccionar la base de datos."; 
      exit(); 
   }    
   return $link; 
} 
?>
