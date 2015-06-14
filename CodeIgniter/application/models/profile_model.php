<?php

/* 
 * created by Nitin Tiwari on 20/12/2014
 */
include_once('/var/www/myproject/CodeIgniter/application/models/base_model.php');
Class profile_model extends base_model{
    
    private $table = "ride.PROFILE";
    private $profileId;
    private $profileData;
    public function __construct() {
        parent::__construct();
    }

    public function doRegistration($data){
        $this->setTableData($this->table, $data);
        return $this->getProfileId($data);
    }
    
    public function updatePassword($password){
        $where = 'PROFILEID =\''.  $this->profileId.'\'';
        $set = array('PASSWORD' =>$password);
        return $this->updateTableData($this->table, $set,$where);
    }
    
    public function getProfileId($data = ''){
        if(empty($this->profileId)){
            if(empty($this->profileData)){
                $this->_setProfileData($data);
            }
            $this->profileId = $this->profileData['PROFILEID'];
        }
        return $this->profileId;
    }
    
    public function getProfileData($data = ''){
        if(empty($this->profileData)){
            $this->_setProfileData($data);
        }
        return $this->profileData;
    }
    
    private function _setProfileId($data){
        $result = $this->getTableData($this->table,'PROFILEID','EMAIL=\''.$data['EMAIL'].'\'');
        foreach($result as $row)
            $this->profileId = $row->PROFILEID;
    }
    
    private function _setProfileData($data){
       $result = $this->getTableData($this->table,'*','EMAIL=\''.$data['EMAIL'].'\'');
       $fields = array('PROFILEID','PASSWORD','NAME','COMPANY_NAME','ADDRESS1','ADDRESS2','CITY','PINCODE','MOBILE','MOBILE2','EMAIL','ACTIVATED');
        foreach($result as $row){
            foreach($fields as $key){
                $this->profileData[$key] = $row->$key;
            }
        } 
        return true;
    }
    
}
?>