<?php 
    require_once 'db/functions.php'; // Funciones de la base de datos

    // Configuración de paginación
    $productosPorPagina = 20; // Total de productos que queremos por pagina
    $pagina = isset($_GET['p']) ? intval($_GET['p']) : 1; // Detectar en que página estamos, si no la tenemos, le añadimos 1
    $offset = ($pagina - 1) * $productosPorPagina;

    // Calcular número de paginas para la paginación
    $totalProductos = contarProductos($db); // Contamos el total de productos para saber el total de páginas
    $totalPaginas = ceil($totalProductos / $productosPorPagina); // Calculamos el total de páginas

    // DATOS
    $productos  = obtenerProductosPaginados($db, $productosPorPagina, $offset);
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
    <title>Tienda de productos PHP - Fran Riera</title>

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- HEADER -->
    <header>
        <h1>Tienda de productos PHP - Fran Riera</h1>
    </header>

    <main>
        
        <!-- PRODUCT GRID -->
         <div class="product-grid">

            <?php if (empty($productos)): ?>
                <p>No hay productos para mostrar.</p>
            <?php else: ?>

                <?php foreach ($productos as $p): ?>

                    <div class="product-card">
                        <img src="https://placehold.co/600x600/EEE/31343C?font=poppins&text=<?= htmlspecialchars($p['nombre']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" />
                        <p class="product-name"><?= htmlspecialchars($p['nombre']) ?></p>
                        <p class="product-category"><?= htmlspecialchars($p['categoria']) ?></p>
                        <p class="product-price"><?= number_format($p['precio'], 2) ?> €</p>

                        <div class="product-button">
                            <a href="product-detail.php?id=<?= $p['id'] ?>">Ver producto</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
 
         </div>
    </main>

    <!-- Paginación -->
    <div class="pagination">

        <!-- Si estamos en una página diferente a la primera página, se mostrará la opción de volver atrás -->
        <?php if ($pagina > 1): ?>
            <a href="?p=<?= $pagina - 1 ?>"> ← </a>
        <?php endif; ?>

        Página <?= $pagina ?> de <?= $totalPaginas ?>

        <!-- Si estamos en una página diferente a la última página, se mostrará la opción de siguiente -->
        <?php if ($pagina < $totalPaginas): ?>
            <a href="?p=<?= $pagina + 1 ?>">→</a>
        <?php endif; ?>
    </div>

</body>
</html>