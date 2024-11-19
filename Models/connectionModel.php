<? 
class ConnectionModel {

    protected $db;

    public function __construct()
    {
        $this->model = new ConnectionModel(); // Create an instance of the model class
        try {
            $db = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            $db=null;
        }
    }
}