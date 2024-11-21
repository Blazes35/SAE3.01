<?php
class DBModel {

    protected $db;

    public function __construct()
    {
        if ($this->db == null) {
            $this->connect();
        }
    }

    public function connect() {
        try {
            $db = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $db;
        } catch (PDOException $e) {
            $this->db = null;
        }
    }
}