<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('/var/www/myproject/CodeIgniter/application/libraries/validationLib.php');
include_once('/var/www/myproject/CodeIgniter/application/libraries/loginLib.php');
class Microsite {
    
    private $validate,$CI,$profile_model,$password,$profileid,$login;
    public function __construct() {
        $this->validate = new validationLib();
        $this->login = new loginLib();
        $this->CI = &get_instance();
        $this->CI->load->model('profile_model');
        $this->profile_model = $this->CI->profile_model;
    }
    
    public function registerProfile($inputData){
        $errors = $this->validate->validateProfile($inputData);
        if(count($errors) > 0){
            return $errors;
        }
        $this->setOtherFields($inputData);
        $res = $this->_saveOnDB($inputData);
        if ($res ==  false)
            return $false;
        return  $this->login->doLogin($this->profileid,$this->password);
    }
    private function _saveOnDB($inputData){
        $password = $inputData['PASSWORD'];
        unset($inputData['PASSWORD']);
        unset($inputData['PASSWORD_CONFIRM']);
        $this->profileid = $this->profile_model->doRegistration($inputData);
        if($this->profileid == false)
            return false;
        $salt = "N1tin@ndR0h@n";
        $this->password = md5($this->profileid.$salt.$password);
        return $this->profile_model->updatePassword($this->password);
    }
    
    public function setOtherFields(&$inputData){
        $inputData['ACTIVATED'] = 'Y';
        $inputData['REGISTER_DATE'] = 'NOW()';
        $inputData['MODIFY_DATE'] = 'NOW()';
    }
}
?>