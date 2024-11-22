<?php
include('conexion1.php'); // Usaremos esta conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    // Inserta los datos en la tabla contacto
    $query = "INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (:nombre, :correo, :asunto, :comentario)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':asunto', $asunto);
    $stmt->bindParam(':comentario', $comentario);

    if ($stmt->execute()) {
        echo "Formulario enviado con éxito.";
    } else {
        echo "Error al enviar el formulario.";
    }
}
?>
