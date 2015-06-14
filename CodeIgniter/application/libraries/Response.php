<?php

/***************************************************************** 
 * made by - Nitin Tiwari
 * Date - 4 June 2015
*******************************************************************/

class Response {
    
    public $response;
    public function __construct(){
    }
    public function createResponse($data){
        $this->response['status'] = 'OK';
        $this->response['code'] = 200;
        if(isset($data['error'])){
            $this->response['error'] = $data['error'];
        }
        else{
            $this->response['data'] = $data;
        }
        return $this->response;
    }
}

?>

