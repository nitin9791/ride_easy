<?php

/*Made By -Nitin Tiwari on 20-12-2014 
 */
include_once(APPPATH.'/controllers/BaseController.php');
include_once(APPPATH.'/libraries/registrationLib.php');
Class Registration extends BaseController{
    
    private $regLib;
    public function __construct() {
        parent::__construct();
	$this->regLib = new registrationLib();
    }
    public function index(){
        $result = $this->regLib->registerProfile($this->inputData);
        echo json_encode($this->responseLib->createResponse($result));
        
       
    }
}
?>
