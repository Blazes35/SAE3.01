<?php
function connectToDatabase() {
    try {
        $connection = new PDO('mysql:host=https://la-projets.univ-lemans.fr/pj-pma;dbname=inf2pj_02', 'root', '');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
?>