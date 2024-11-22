<?php
include('conexion1.php'); // Usaremos esta conexión

try {
    // Consulta para obtener los datos de la tabla 'titulos'
    $stmt = $pdo->prepare("SELECT id_titulo, titulo, id_pub, fecha_pub FROM titulos");
    $stmt->execute();
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($libros)) {
        $mensaje = "No se encontraron libros en la base de datos.";
    }
} catch (PDOException $e) {
    $mensaje = "Error al conectar o consultar la base de datos: " . $e->getMessage();
    $libros = [];
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Librería Martinez </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css"> <!-- Archivo CSS personalizado -->
</head>
<body>
    <div class="container my-5">
        <div class="text-center">
            <h1>Bienvenidos a Nuestra Librería Online</h1>
            <p class="lead">En nuestra librería, podrás encontrar una amplia selección de libros de todos los géneros. ¡Explora, descubre y disfruta!</p>
        </div>

        <div class="row text-center">
            <div class="col-md-4">
                <a href="libros.php" class="btn btn-primary btn-lg w-100">Ver Libros</a>
            </div>
            <div class="col-md-4">
                <a href="autores.php" class="btn btn-secondary btn-lg w-100">Ver Autores</a>
            </div>
            <div class="col-md-4">
                <a href="contacto.php" class="btn btn-success btn-lg w-100">Contacta con Nosotros</a>
            </div>
        </div>

        <div class="text-center mt-5">
            <h2>Lo que ofrecemos:</h2>
            <p>Consulta libros, lee sus detalles y conoce a los autores que los hicieron posibles. Además, mantente en contacto con nosotros para obtener más información o resolver tus dudas.</p>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
