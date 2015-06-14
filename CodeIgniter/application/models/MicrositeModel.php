<?php

/* 
 * created by Nitin Tiwari on 20/12/2014
 */
include_once('/var/www/myproject/CodeIgniter/application/models/BaseModel.php');
Class MicrositeModel extends BaseModel{
    
    private $table = "meals.MICROSITE_DATA";
    public function __construct() {
        parent::__construct();
    }
}
?>

