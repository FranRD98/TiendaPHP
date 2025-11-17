<?php 
    require_once 'db/functions.php'; // Funciones de la base de datos

    // Obtenemos el parametro ID de la URL para poder pintar los detalles del producto
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if (!$id) {
        die("ID de producto no válido");
    }
        
    $producto  = obtenerProductoPorId($db, $id); // Obtenemos el resultado de la consulta de los productos
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tipografía Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title><?= $producto['nombre'] ?> - Tienda de productos PHP - Fran Riera</title>

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- HEADER -->
    <header>
        <h1>Producto - Fran Riera</h1>
    </header>

    <main>
        
        <h2>Listado de productos</h2>
        <div class="back-button">
            <a href="/product-list.php">Volver atrás</a>
        </div>

        <!-- PRODUCT DETAIL -->
        <?php if (empty($producto)): ?>
            <p>Producto no encontrado.</p>
        <?php else: ?>

            <div class="product-detail">
                <img src="https://placehold.co/600x600/EEE/31343C?font=poppins&text=<?= htmlspecialchars($producto['nombre']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" />
                <div class="product-data">
                    <p class="product-name"><?= htmlspecialchars($producto['nombre']) ?></p>
                    <p class="product-category"><?= htmlspecialchars($producto['categoria']) ?></p>
                    <p class="product-price"><?= number_format($producto['precio'], 2) ?> €</p>
                </div>
            </div>
        <?php endif; ?>
 
    </main>

</body>
</html>