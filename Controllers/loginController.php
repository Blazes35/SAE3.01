<?php
require_once 'Models/loginModel.php';

class loginController
{
    private $model;

    public function __construct()
    {
        $this->model = new LoginModel(); // Create an instance of the model class
    }

    public function renderLayout()
    {
        ob_start();

        return ob_get_clean();
    }

    public function login($username, $password)
    {
        return $this->model->login($username, $password);
    }

    public function createUser($username, $password)
    {
        return $this->model->createUser($username, $password);
    }

    public function changePwd($username, $password)
    {
        return $this->model->changePwd($username, $password);
    }
}