<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class test extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $sql = "insert into meals.PROFILE(NAME) VALUES('NITIN')";
        $this->load->database();
        $this->db->query($sql);
    }
}
?>