<?php
class DBModel {

    protected static $db;

    public function __construct()
    {
        if (self::$db == null) {
            $this->connect();
        }
    }

    public function connect() {
        try {
            $db = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db = $db;
        } catch (PDOException $e) {
            self::$db = null;
        }
    }
}