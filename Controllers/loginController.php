<?php
require_once 'Models/loginModel.php';

class loginController
{
    private $model;

    public function __construct() {
        $this->model = new LoginModel();
    }

    public function login($username, $password) {
        return $this->model->login($username, $password);
    }

    public function renderLayout()
    {
        ob_start();
        return ob_get_clean();
    }
}