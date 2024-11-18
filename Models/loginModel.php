<? 
require_once 'model/connection.php';

class loginModel extends Connection{

    public function __construct()
    {
        $this->model = new Connection(); // Create an instance of the model class
    }

    public function login($username, $password) {
        $sql = "call login(\"$username\")";
        $init = $db -> prepare($sql);
        $init -> execute();
        $result = $init->fetch()[0];
        if ($result==-1){
            $return = "Erreur email ou mot de passe incorrect";
        } else {
            $return = password_verify($password, $result) ? "Connexion réussie" : "Erreur email ou mot de passe incorrect";
        };
        return $return;
    }

}