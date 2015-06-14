<?php

/*Made By -Nitin Tiwari on 20-12-2014 
 */
include_once('/var/www/myproject/CodeIgniter/application/controllers/BaseController.php');
include_once('/var/www/myproject/CodeIgniter/application/libraries/micrositeLib.php');
Class MicrositePannel extends BaseController{
    
    private $micrositeLib;
    public function __construct() {
        parent::__construct();
        $this->micrositeLib = new MicrositeLib();
    }
    public function index(){
        $result = $this->micrositeLib->placeMenu($this->inputData);
    }
    public function microSitePannelView(){
        if(isset($_COOKIE['LOGIN'])){
            echo 'already registered';
        }
        else{
            $this->load->view('html_register.php');
        }
    }
}
?>