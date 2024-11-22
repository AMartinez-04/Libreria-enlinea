<?php
include('navbar.php'); // barra fija 
include('conexion1.php'); // Usaremos esta conexión

// Variables para el mensaje de confirmación
$mensaje_confirmacion = "";
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valida el formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);
    
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico es obligatorio y debe ser válido.";
    }
    if (empty($mensaje)) {
        $errores[] = "El mensaje no puede estar vacío.";
    }

    // Si no hay errores, procesar el formulario
    if (empty($errores)) {
        

        // Mensaje de confirmación
        $mensaje_confirmacion = "Gracias, $nombre. Hemos recibido tu mensaje y te contactaremos pronto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css"> 
</head>
<body>


    <div class="container my-5">
        <h1 class="text-center mb-4">Contacto</h1>
        <p class="text-muted text-center mb-5">Contáctanos para más información.</p>

        <!-- Mostrar mensaje de confirmación si es exitoso -->
        <?php if ($mensaje_confirmacion): ?>
            <div class="alert alert-success text-center">
                <?php echo $mensaje_confirmacion; ?>
            </div>
        <?php endif; ?>

        <!-- Mostrar errores de validación si existen -->
        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulario de contacto -->
        <form method="POST" action="contacto.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required><?php echo isset($mensaje) ? htmlspecialchars($mensaje) : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    
    <script>
        document.querySelector('form').addEventListener('submit', function (event) {
            const nombre = document.getElementById('nombre').value.trim();
            const email = document.getElementById('email').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();

            let valid = true;

            if (!nombre) {
                alert("El nombre es obligatorio.");
                valid = false;
            }
            if (!email || !email.includes('@')) {
                alert("El correo electrónico debe ser válido.");
                valid = false;
            }
            if (!mensaje) {
                alert("El mensaje no puede estar vacío.");
                valid = false;
            }

            if (!valid) {
                event.preventDefault(); // Evita el envío del formulario si no es válido
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
