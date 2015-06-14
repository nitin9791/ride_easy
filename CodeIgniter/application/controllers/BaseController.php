<?php

/* 
 * Made By Nitin Tiwari 20/12/2014
*/
include_once('/var/www/myproject/CodeIgniter/application/libraries/Request.php');
include_once('/var/www/myproject/CodeIgniter/application/libraries/Response.php');
Class BaseController extends CI_Controller{
    
    public $inputData;
    public $responseLib;
    public function __construct() {
        parent::__construct();
        $this->_initialize();
        $this->isIfValid = $this->processRequest();
        $this->responseLib = new Response();
        if(!$this->isIfValid){
            $data['error']['msg'] = 'Not a Valid Key';
            $data['error']['code'] = 3;
            echo json_encode($this->responseLib->createResponse($data));
            exit(0);
        }
    }
    private function _initialize() {
        $_GET = $this->input->_clean_input_data($_GET);
        $_POST = $this->input->_clean_input_data($_POST);
        $this->formatData($this->inputData);
    }
    
    protected function formatData(&$inputData) {
        foreach ( $_POST as $key => $value ) {
                $key = strtoupper($key);
                $inputData [$key] = $value;
        }
        foreach ( $_GET as $key => $value ) {
                $key = strtoupper($key);
                $inputData [$key] = $value;
        }
    }
    
     public function getInputData(){
        if(empty($this->inputData)){
            $this->_initialize();
        }
        return $this->inputData;
    }
    
    public function processRequest(){
        $request = new Request();
        $result = $request->processRequest($this->inputData);
        unset($this->inputData);
        return $result;
        
    }
}
?>