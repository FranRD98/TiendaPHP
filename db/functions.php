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

?>