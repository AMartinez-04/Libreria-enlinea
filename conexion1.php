<?php
$host = 'localhost'; 
$dbname = 'libreria'; // Nombre de la base de datos
$username = 'root'; 
$password = ''; 

try {
    // Conexión usando PDO con MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Comentamos la línea de éxito para evitar mostrar mensajes
    // echo "Conexión exitosa"; 
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage()); // Mostramos el error solo si ocurre un problema
}
?>
