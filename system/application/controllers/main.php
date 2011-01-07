<?php
require_once(APPPATH . "/controllers/application.php");
class Main extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->load->library('session');
        }

    function index()
        {
        $xPage = "Home";
        $xLogIn = $this->session->userdata("IsLoggedIn");

        if ( !isset($xLogIn) || $xLogIn !== true )
        {
            $xPage = $this->load->view("Login",'',true);
        }
            
        $this->mysmarty->view('main/index',array("xPage" => $xPage));
        }
    }
