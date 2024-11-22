<?php
require_once 'Models/ConnectionModel.php';

class Updatepwd{
    private $model;

    public function __construct() {
        $this->model = new ConnectionModel();
    }

    public function changePwd($mail, $oldPassword, $newPassword) {
        return $this->model->changePwd($mail, $oldPassword, $newPassword);
    }

    public function renderLayout()
    {
        ob_start();
        return ob_get_clean();
    }
}