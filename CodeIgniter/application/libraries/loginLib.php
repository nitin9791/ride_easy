<?php

/* 
 * Nitin Tiwari
 * by - 05/01/2015
 */
include_once('/usr/local/my_web_config.php');
include_once(CODEIGNITER_PATH.'/libraries/validationLib.php');
class loginLib {
    
    private $validate;
    private $profileid;
    private $ci;
    private $profileData;
    public function __construct() {
        $this->validate = new validationLib();
        $this->ci = &get_instance();
    }
    public function login($inputData){
        $errors = $this->validate->validateProfile($inputData);
        if(count($errors) > 0){
            return $errors;
        }
        if($this->authenticate($inputData)){
            $this->dologin($this->profileid);
        }
        else{
            echo 'authentication failed';
        }
    }
    public function doLogin($profileid){
        $salt = "N1tin@ndR0h@n";
        $val = md5($salt.$profileid.$salt);
        return setcookie('LOGIN',$val,time()+9999999999,"/");
    }
    public function authenticate($inputData){
        $this->ci->load->model('profile_model');
        $this->profileData = $this->ci->profile_model->getProfileData($inputData);
        $this->profileid = $this->ci->profile_model->getProfileId($inputData);
        $salt = "N1tin@ndR0h@n";
        $passwordForCheck = md5($this->profileid.$salt.$inputData['PASSWORD']);
        if($this->profileData['PASSWORD'] == $passwordForCheck){
            return true;
        }
        else{
            return false;
        }
    }
}

?>