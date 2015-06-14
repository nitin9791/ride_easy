<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(APPPATH.'/libraries/validationLib.php');
class registrationLib {
    
    private $validate,$CI,$profile_model,$password,$profileid,$login;
    public function __construct() {
	$this->validate = new validationLib();
        $this->CI = &get_instance();
        $this->CI->load->model('user_model');
        $this->user_model = $this->CI->user_model;
    }
    
    public function registerProfile($inputData){
        $errors = $this->validate->validateProfile($inputData);
        if(count($errors) > 0){
            return $errors;
        }
        $this->setOtherFields($inputData);
        $res = $this->_saveOnDB($inputData);
        if ($res ==  false){
            $errors['error']['msg'] = "Data not Saved DB Down";
            $errors['error']['code'] = 3;
            return $errors;
        }
        else{
            return $this->user_model->getUserData();
        }
    }
    private function _saveOnDB($inputData){
        $password = $inputData['PASSWORD'];
        unset($inputData['PASSWORD']);
        $this->user_id = $this->user_model->doRegistration($inputData);
        if($this->user_id == false)
            return false;
        $salt = "N1tin@ndR0h@n";
        $this->password = md5($this->user_id.$salt.$password);
        return $this->user_model->updatePassword($this->password);
    }
    
    public function setOtherFields(&$inputData){
       	$inputData['IS_ACTIVE'] = 'Y';
        $inputData['REGISTER_DATE'] = 'NOW()';
    }
}
?>
