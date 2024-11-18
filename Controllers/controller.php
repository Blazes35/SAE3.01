<?php
require_once 'Models/model.php';

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model(); // Create an instance of the model class
    }

    public function renderLayout()
    {
        ob_start();
        include 'view/layout.php';
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