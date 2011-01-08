<?php
require_once(APPPATH . "/controllers/application.php");

class Profile extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();


        }

    function index()
        {
        $this->mysmarty->view('profile/index');
        }

    function view()
        {
        }
    }
