<?php

/* 
 created By Nitin Tiwari
 * 4/01/2015
 */
include_once(APPPATH.'/helpers/validation_helper.php');
include_once(PROJECT_PATH.'/validation_constants.php');
class validationLib{
    public function __construct() {
        $CI = &get_instance();
	$CI->load->helper('validation_helper');
    }
    public function validateProfile($inputData){
        global $errors,$error_codes,$profileInfo;
	$fields = $this->_getTableFields($profileInfo);
	return $this->_validate($inputData, $fields, $errors,$error_codes);
    }
    
    private function _getTableFields($tableInfo){
        global $validation_fields;	
        $tableFields = array();
        foreach ($tableInfo as $key){
            $tableFields[$key] = $validation_fields[$key];
        }
        return $tableFields;
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
                        try{
				$result = call_user_func_array($function,$arguments);
                        	if(!$result){
                            		$errs['error'][$inputField]['msg'] = $errors[$err[$validationKey]];
                            		$errs['error'][$inputField]['code'] = $codes[$err[$validationKey]];
                        	}
			}
			catch(Exception $ex){
				error_log('there is some problem in '.__LINE__.' '.__FILE__);
			}

                    }
                }
            }
        }
        return $errs;
    }
}
?>
