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
            $xPage = "Login";

        $this->load->view("Main", array("xPage" => $xPage));
        }
    }
