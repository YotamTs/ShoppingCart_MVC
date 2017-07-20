<?php

class Logout extends CI_Controller {
 
    function __construct() {
        parent::__construct();
    }
 
    function index() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }
}
