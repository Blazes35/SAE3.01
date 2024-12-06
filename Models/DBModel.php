<?php

class DBModel {
    protected static $db;

    public function __construct() {
        if (self::$db === null) {
            $this->connect();
        }
    }

    public function connect() {
        try {
            $db = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'inf2pj02', 'iXeikoas3o');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db = $db;
        } catch (PDOException $e) {
            self::$db = null;
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getDB() {
        if (self::$db === null) {
            throw new Exception("Connexion à la base de données non établie.");
        }
        return self::$db;
    }
}
