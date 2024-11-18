<?php
function connectToDatabase() {
    try {
        $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function login($connection, $username, $password) {
    $sql = "call login(\"$username\",$password)";
    $init = $connection -> prepare($sql);
    $init -> execute();
    $result = $init->fetch()[0];
    return $result;
}