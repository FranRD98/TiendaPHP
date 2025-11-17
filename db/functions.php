<?php
    // Conexión a la base de datos
    try {
        $db = new PDO("sqlite:db/prueba.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch (Exception $e) {
        die("Error conectando a la base de datos: " . $e->getMessage());
    }

?>