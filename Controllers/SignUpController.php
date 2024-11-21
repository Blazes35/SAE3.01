<?php
require_once 'Models/ConnectionModel.php';

class SignUpController{
    private $model;

    public function __construct() {
        $this->model = new ConnectionModel();
    }

    public function signUp($nom, $prenom, $classe, $mail, $password) {
        return $this->model->createUser($nom, $prenom, $mail, $password, $classe);
    }

    public function renderLayout()
    {
        ob_start();
        return ob_get_clean();
    }
}