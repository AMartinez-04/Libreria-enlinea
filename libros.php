<?php
include('navbar.php'); 
// Incluir archivo de conexión
include('conexion1.php'); // Usaremos esta conexión


try {
    // Consulta SQL para obtener todos los libros
    $stmt = $pdo->prepare("SELECT * FROM titulos");
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
    <title>Libros Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css"> 
</head>
<body>
   

    <div class="container my-5">
        <h1 class="text-center mb-4">Libros Disponibles</h1>
        <p class="text-muted text-center mb-5">Consulta nuestra colección de libros destacados.</p>

        <?php if (isset($mensaje)): ?>
            <div class="alert alert-warning text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($libros as $libro): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            
                            <img src="<?php echo htmlspecialchars($libro['imagen'] ?? 'imagenes/book.jpg'); ?>" 
                                 class="card-img-top" alt="Libro">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($libro['notas']); ?></p>
                                <a href="detalle_libro.php?id=<?php echo htmlspecialchars($libro['id_titulo']); ?>" class="btn btn-primary">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
