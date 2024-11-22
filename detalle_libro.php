<?php
include('navbar.php');
include('conexion1.php'); // Usaremos esta conexión


try {
    // Obtener el id_titulo de la URL
    if (isset($_GET['id'])) {
        $id_titulo = $_GET['id'];

        // Consulta para obtener los detalles del libro
        $stmt = $pdo->prepare("SELECT * FROM titulos WHERE id_titulo = :id_titulo");
        $stmt->bindParam(':id_titulo', $id_titulo, PDO::PARAM_STR);
        $stmt->execute();
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$libro) {
            $mensaje = "El libro no existe.";
        }
    } else {
        $mensaje = "No se ha seleccionado ningún libro.";
    }
} catch (PDOException $e) {
    $mensaje = "Error al conectar o consultar la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Libro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    

    <div class="container my-5">
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-warning text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php else: ?>
            <h1 class="text-center"><?php echo htmlspecialchars($libro['titulo']); ?></h1>
            <div class="row">
                <div class="col-md-6">
                    <!-- Mostraremos la imagen común para todos los libros -->
                    <img src="imagenes/id_titulo.jpg" class="img-fluid" alt="Imagen del Libro">
                </div>
                <div class="col-md-6">
                    <h3>Detalles del Libro</h3>
                    <p><strong>Autor:</strong> <?php echo htmlspecialchars($libro['id_pub']); ?></p>
                    <p><strong>Fecha de Publicación:</strong> <?php echo date("d/m/Y", strtotime($libro['fecha_pub'])); ?></p>
                    <p><strong>Precio:</strong> $<?php echo number_format($libro['precio'], 2); ?></p>
                    <p><strong>Avance de Ventas:</strong> <?php echo number_format($libro['avance'], 2); ?>%</p>
                    <p><strong>Notas:</strong> <?php echo nl2br(htmlspecialchars($libro['notas'])); ?></p>
                    <a href="libros.php" class="btn btn-secondary">Volver a la lista de libros</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
