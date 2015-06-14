<?php

/* 
 * By - Nitin Tiwari
 * on 04/01/2015
 */
function notEmpty($val){
    return !empty($val);
}
function isName($val){
    $reg = '/^[a-zA-Z ]+$/';
    if(!empty($val) && strlen($val) >= 3 && strlen($val) <=30 && preg_match($reg, $val)){
        return true;
    }
    else {
        return false;
    }      
}

function isPassword($val){
    if(!empty($val) && strlen($val) >= 6 && strlen($val) <=30){
        return true;
    }
    else {
        return false;
    }
}

function isCountryCode($val){
    $reg = '/^[1-9][0-9]*$/';
    if(!empty($val) && strlen($val) >= 1 && strlen($val) <=4 && preg_match($reg, $val)){
        return true;
    }
    else {
        return false;
    }
}

function isCity($val){
    $reg = '/^[a-zA-Z ]+$/';
    if(!empty($val) && strlen($val) >= 4 && strlen($val) <=20 && preg_match($reg, $val)){
        return true;
    }
    else {
        return false;
    }
}

function isPinCode($val){
    $reg = '/^[1-9][0-9]*$/';
    if(!empty($val) && strlen($val) == 6 && preg_match($reg, $val)){
        return true;
    }
    else {
        return false;
    }
}

function isEmail($val){
    if(!empty($val) && strlen($val) >= 3 && strlen($val) <=30 && filter_var($val, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else {
        return false;
    }
}

function isMobile($val){
    $reg = '/^[1-9][0-9]*$/';
    if(!empty($val) && strlen($val) == 10 && preg_match($reg, $val)){
        return true;
    }
    else {
        return false;
    }
}

function isTime($val){
	$time = explode(':',$val);
	if(!empty($time)){
		if(is_numeric($time[0]) && is_numeric($time[1]) && $time[0] >= 0 $time[1] <= 23 && $time[1] >=0 && $time[1] <= 59)
			return true;
	}
	return false;
}

function isBoolean($val){
	if($val =='0' || $val =='1' || $val ==true || $val == false)
		return true;
	return false;
}
?>
