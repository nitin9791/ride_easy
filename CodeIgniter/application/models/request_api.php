<?php

/***************************************************************** 
 * made by - Nitin Tiwari
 * Date -2 June 2015
*******************************************************************/

include_once('/var/www/myproject/CodeIgniter/application/models/base_model.php');
Class  request_api extends base_model {
    
    private $table = "ride.REQUEST";
    public function __construct() {
        parent::__construct();
    }
 
    public function isCorrectKey($key){
        $result = $this->getTableData($this->table,'*','API_KEY=\''.$key.'\' AND ACTIVATED = \'Y\'');
        return count($result) > 0 ? true:false;
    }
    
}
