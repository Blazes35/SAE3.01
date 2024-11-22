<?php
require_once 'Models/mainModel.php';

class Treasury{

    public function renderLayoutAdmin()
    {
        ob_start();
        return ob_get_clean();
    }

    
}