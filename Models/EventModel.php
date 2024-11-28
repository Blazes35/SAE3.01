
<?php
require_once 'DBModel.php';
class EventModel extends DBModel {


    public function __construct() {
        parent::__construct();
    }

    public function getAllEvents() {
        $sql = "SELECT * FROM EVENEMENT";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        return ($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
