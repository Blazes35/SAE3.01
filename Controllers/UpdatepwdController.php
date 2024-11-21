<?php
require_once 'Models/ConnectionModel.php';

class Updatepwd{
    private $model;

    public function __construct() {
        $this->model = new ConnectionModel();
    }

    public function changePwd($mail, $password) {
        return $this->model->changePwd($mail, $password);
    }

    public function renderLayout()
    {
        ob_start();
        return ob_get_clean();
    }
}