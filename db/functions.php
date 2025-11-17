<?php
    // Conexión a la base de datos
    try {
        $db = new PDO("sqlite:db/prueba.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        die("Error conectando a la base de datos: " . $e->getMessage());
    }

    // Obtener los productos
    function obtenerProductosPaginados(PDO $db, $limit, $offset) {
        $sql = "
            SELECT p.id, p.nombre, p.precio, c.categoria AS categoria
            FROM productos p
            JOIN categorias c 
                ON c.id = CAST('10' || p.categoria AS INTEGER)
            ORDER BY p.id
            LIMIT :limit OFFSET :offset
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener los detalles del producto mediante su ID
    function obtenerProductoPorId(PDO $db, $id) {
        $sql = "
            SELECT p.id, p.nombre, p.precio, c.categoria AS categoria
            FROM productos p
            JOIN categorias c ON CAST('10' || p.categoria AS INTEGER) = c.id
            WHERE p.id = :id
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        function contarProductos(PDO $db) {
        $stmt = $db->query("SELECT COUNT(*) FROM productos");
        return (int)$stmt->fetchColumn();
    }

?>