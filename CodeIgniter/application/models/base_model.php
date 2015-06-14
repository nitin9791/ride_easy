<?php

/* created By - Nitin Tiwari on 20/12/2014
 */
Class base_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getTableData($table,$columns='*',$where='',$limit='',$group='',$order=''){
        if(!empty($table)){
            $sql = "SELECT $columns FROM $table";
            if($where != '')
                $sql .= " WHERE $where";
            if($group != '')
                $sql .= " GROUP BY $group";
            if($order != '')
                $sql .= " ORDER BY $order";
            if($limit != '')
                $sql .= " LIMIT $limit";
            return $this->db->query($sql)->result();
        }
        return false;
    }
    
    public function setTableData($table,$data){
        if(!empty($table) && !empty($data)){
            $timeStampFields = $this->getTimeStampFields();
            $keys = array();
            $values = array();
            $date_keys = array();
            $date_values = array();
            foreach($data as $key=>$value){
                /*FOR DATE THING*/
                if(in_array($key, $timeStampFields)){
                    $date_keys[] = $key;
                    $date_values[] = $value;
                }
                else {
                    $keys[] = $key;
                    $values[] = $value;
                }
            }
            $key = implode(",",$keys);
            $value = "'".implode("','",$values)."'";
            $date_key = implode(",",$date_keys);
            $date_value = implode(",",$date_values);
            if(!empty($date_keys)){
                $key .=",$date_key";
                $value .=",$date_value";   
            }
            return $this->insertIntoTable($table,$key,$value);
        }
        return false;
    }
    
    private function insertIntoTable($table,$key,$value){
        $sql = "INSERT INTO $table($key) VALUES($value)";
        return $this->db->query($sql);
    }
    
    public function updateTableData($table,$data,$where=''){
        if(!empty($table) && !empty($data)){
            $set = array();
            foreach($data as $key=>$value){
                $set[] = "$key='$value'";
            }
            $set = implode(",",$set);
            return $this->updateTable($table,$set,$where);
        }
        return false;
    }
    
    private function updateTable($table,$set,$where){
        $sql = "UPDATE $table set $set";
        if($where != ''){
            $sql .= " WHERE $where";
        }
        return $this->db->query($sql);
        
    }
    private function getTimeStampFields(){
        $timeStamps = array('MODIFY_DATE','REGISTER_DATE');
        return $timeStamps;
    }
}
?>