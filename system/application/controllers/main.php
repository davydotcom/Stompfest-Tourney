<?php

class Main extends Controller
    {
    function  __construct()
        {
   		parent::Controller();

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
