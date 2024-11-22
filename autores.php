<?php
include('navbar.php'); 
include('conexion1.php'); // Usaremos esta conexión

// Consulta SQL para obtener todos los autores
try {
    $stmt = $pdo->prepare("SELECT * FROM autores"); 
    $stmt->execute();
    $autores = $stmt->fetchAll(PDO::FETCH_ASSOC); // 
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css"> 
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Autores Disponibles</h1>
        <p class="text-muted text-center mb-5">Consulta nuestra lista de autores destacados.</p>
        <div class="row">
            <?php if (!empty($autores)): // Comprobar si hay autores ?>
                <?php foreach ($autores as $autor): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <!-- Con esto ponemos una imagen fija para todos los autores -->
                            <img 
                                src="imagenes/autores/default_autor.png" 
                                class="card-img-top" 
                                alt="Autor">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($autor['nombre']); ?></h5>
                                <!-- Mostrar el país en lugar de la descripción -->
                                <p class="card-text">
                                    <?php 
                                        echo !empty($autor['pais']) 
                                            ? htmlspecialchars($autor['pais']) 
                                            : 'País no disponible'; 
                                    ?>
                                </p>
                                <a href="https://es.wikipedia.org/wiki/Wikipedia:Portada" class="btn btn-primary" target="_blank">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-danger">No se encontraron autores en la base de datos.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
