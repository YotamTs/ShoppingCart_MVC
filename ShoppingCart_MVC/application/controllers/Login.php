<?php

class Login extends CI_Controller {
 
    function __construct() {
        parent::__construct(); 
        $this->load->helper(array('form'));  
        $this->load->library('session');
    }
 
    function index() {  
        $this->load->view('login_view');
    }
}
