<?php
require_once(APPPATH . "/controllers/application.php");

class Profile extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();
        }

    function index()
        {
        $this->mysmarty->view('profile/index');
        }

    function view()
        {
        }

    function update()
        {
//            $this->currentUser->
        }
    }
