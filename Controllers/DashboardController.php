<?php
require_once 'Models/mainModel.php';

class Dashboard{

    public function renderLayoutAdmin()
    {
        ob_start();
        return ob_get_clean();
    }

    
}