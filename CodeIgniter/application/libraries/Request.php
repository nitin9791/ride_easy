<?php

/***************************************************************** 
 * made by - Nitin Tiwari
 * Date -2 June 2015
 * This Library is to Authenticate the Request
*******************************************************************/

Class Request {
    
    private $request_api;
    public function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->model('request_api');
        $this->request_api = $this->CI->request_api;
    }
    
    public function processRequest($inputData){
        if(!empty($inputData['APIKEY'])){
          return  $this->authenticateKey($inputData['APIKEY']);
        }
        else{
            return false;
        }
    }
    
    private function authenticateKey($key){
        if(!empty($key)){
            return $this->request_api->isCorrectKey($key);
        }
        else{
            return false;
        }
    }
}
