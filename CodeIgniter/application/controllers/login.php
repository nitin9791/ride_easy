<?php

/* 
 made by - Nitin Tiwari
 * on 05/01/2015
 */
include_once('/var/www/myproject/CodeIgniter/application/controllers/BaseController.php');
include_once('/var/www/myproject/CodeIgniter/application/libraries/loginLib.php');
Class login extends BaseController{
    
    private $loginLib;
    public function __construct() {
        parent::__construct();
        $this->loginLib = new loginLib();
    }
    public function index(){
        $result = $this->loginLib->login($this->inputData);
    }
    public function loginPage(){
        if(isset($_COOKIE['LOGIN'])){
            echo "already login";
        }
        else{
            $this->load->view('html_login.php');
        }
    }
}
?>