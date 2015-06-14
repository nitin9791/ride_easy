<?php

/* 
 created By Nitin Tiwari
 * 4/01/2015
 */
include_once('/var/www/myproject/CodeIgniter/application/helpers/validation_helper.php');
class validationLib{
    public function __construct() {
        $CI = &get_instance();
        $CI->load->helper('validation_helper');
    }
    public function validateProfile($inputData){
        $fields = $this->getProfileFieldsForValidation();
        $errors = $this->getErrorMsg();
        $error_codes = $this->getErrorCode();
        return $this->_validate($inputData, $fields, $errors);
    }
    
    public function getFieldValidation() {
        $feild = array(
            'PASSWORD' =>  array('method' => array('notEmpty'=>true,'isPassword'=>true),'errors'=>array('notEmpty'=>'EPPASS','isPassword'=>'PROPPASS')),
            'NAME' =>  array('method' => array('notEmpty'=>true,'isName'=>true),'errors'=>array('notEmpty'=>'EPNAME','isName'=>'PROPNAME')),
            'COMPANY_NAME' =>  array('method' => array('notEmpty'=>true),'errors'=>array('notEmpty'=>'EPCOMP')),
            'ADDRESS1' =>  array('method' => array('notEmpty'=>true),'errors'=>array('notEmpty'=>'EPADDR')),
            'ADDRESS2' =>  array('method' => array(),'errors' => array()),
            'COUNTRY_CODE' =>  array('method' => array('notEmpty'=>true,'isCountryCode'=>true),'errors'=>array('notEmpty'=>'EPCC','isCountryCode'=>'PROPCC')),
            'CITY' =>  array('method' => array('notEmpty'=>true,'isCity'=>true),'errors'=>array('notEmpty'=>'EPCITY','isCity'=>'PROPCITY')),
            'PINCODE' =>  array('method' => array('notEmpty'=>true,'isPincode'=>true),'errors'=>array('notEmpty'=>'EPPIN','isPincode'=>'PROPPIN')),
            'EMAIL' =>  array('method' => array('notEmpty'=>true,'isEmail'=>true),'errors'=>array('notEmpty'=>'EPEMAIL','isEmail'=>'PROPEMAIL')),
            'MOBILE' =>  array('method' => array('notEmpty'=>true,'isMobile'=>true),'errors'=>array('notEmpty'=>'EPMOB','isMobile'=>'PROPMOB')),
        );
        return $feild;
    }
    public function getTableFields($tableInfo){
        $fields = $this->getFieldValidation();
        $tableFields = array();
        foreach ($tableInfo as $key){
            $tableFields[$key] = $fields[$key];
        }
        return $tableFields;
    }
    public function getProfileFieldsForValidation(){
        $profileInfo = array('NAME','PASSWORD','COMPANY_NAME','ADDRESS1','ADDRESS2','COUNTRY_CODE','CITY','PINCODE','EMAIL','MOBILE');
        $fields = $this->getTableFields($profileInfo);
        return $fields;
    }
    
    public function getErrorMsg(){
        $err = array(
            'EPPASS'=>'Password should not be empty',
            'EPNAME'=>'Name should not be empty',
            'EPCOMP'=>'Company Name should not be empty',
            'EPADDR' => 'Address should not be empty',
            'EPCC' => 'Country Code should not be empty',
            'EPCITY' => 'City should not be empty',
            'EPPIN' => 'Pincode should not be empty',
            'EPEMAIL' => 'Email should not be empty',
            'EPMOB' => 'Mobile should not be empty',
            'EPINFOR' => 'Details should not be empty',
            'PROPPASS' => 'Not a proper Password',
            'PROPNAME' => 'Not a proper Name',
            'PROPCC' => 'Not a proper Country Code',
            'PROPCITY' => 'Not a proper City',
            'PROPPIN' => 'Not a proper Pincode' ,
            'PROPMOB' => 'Not a proper Mobile',
            'PROPEMAIL'=> 'Not a proper Email',
            
            
        );
        return $err;
    }
    
    public function getErrorCode(){
        $codes = array(
            'EPPASS'=>1,
            'EPNAME'=>1,
            'EPCOMP'=>1,
            'EPADDR' => 1,
            'EPCC' => 1,
            'EPCITY' => 1,
            'EPPIN' => 1,
            'EPEMAIL' =>1,
            'EPMOB' => 1,
            'EPINFOR' => 1,
            'PROPPASS' => 2,
            'PROPNAME' => 2,
            'PROPCC' => 2,
            'PROPCITY' =>2,
            'PROPPIN' => 2 ,
            'PROPMOB' => 2,
            'PROPEMAIL'=> 2,
        );
        return $codes;
    }

    private function _validate($inputData,$fields,$errors,$codes){
        $errs = array();
        foreach($inputData as $inputField => $inputFieldValue){
            if(array_key_exists($inputField, $fields)){
                $validation = $fields[$inputField]['method'];
                $err = $fields[$inputField]['errors'];
                foreach($validation as $validationKey => $validationValue) {
                    if($validationValue == true && !array_key_exists($inputField, $errs)){
                        $function = $validationKey;
                        $arguments = array($inputFieldValue);
                        $result = call_user_func_array($function,$arguments);
                        if(!$result){
                            $errs['error'][$inputField]['msg'] = $errors[$err[$validationKey]];
                            $errs['error'][$inputField]['code'] = $codes[$err[$validationKey]];
                        }
                    }
                }
            }
        }
        return $errs;
    }
}
?>