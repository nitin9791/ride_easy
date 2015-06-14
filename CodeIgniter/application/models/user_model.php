<?php

/* 
 * created by Nitin Tiwari on 20/12/2014
 */
include_once(APPPATH.'/models/base_model.php');

Class user_model extends base_model{
    
    private $table = "ride.USER";
    private $user_id;
    private $userData;
    public function __construct() {
        parent::__construct();
    }

    public function doRegistration($data){
        $this->setTableData($this->table, $data);
        return $this->getUserId($data);
    }
    
    public function updatePassword($password){
        $where = 'USER_ID =\''.  $this->user_id.'\'';
        $set = array('PASSWORD' =>$password);
        return $this->updateTableData($this->table, $set,$where);
    }
    
    public function getUserId($data = ''){
        if(empty($this->user_id)){
            if(empty($this->userData)){
                $this->_setUserData($data);
            }
            $this->user_id = $this->userData['USER_ID'];
        }
        return $this->user_id;
    }
    
    public function getUserData($data = ''){
        if(empty($this->userData)){
            $this->_setUserData($data);
        }
        return $this->userData;
    }
    
    private function _setUserId($data){
        $result = $this->getTableData($this->table,'USER_ID','EMAIL=\''.$data['EMAIL'].'\'');
        foreach($result as $row)
            $this->user_id = $row->USER_ID;
    }
    
    private function _setUserData($data){
       $result = $this->getTableData($this->table,'*','EMAIL=\''.$data['EMAIL'].'\'');
       $fields = array('USER_ID','NAME','COMPANY_NAME','OFFICE_ADDRESS','HOME_ADDRESS','CONTACT','EMAIL','IS_ACTIVE','HAS_CAR','START_TIME_PICKUP','OFFICE_TIME_PICKUP');
        foreach($result as $row){
            foreach($fields as $key){
                $this->userData[$key] = $row->$key;
            }
        } 
        return true;
    }
    
}
?>
