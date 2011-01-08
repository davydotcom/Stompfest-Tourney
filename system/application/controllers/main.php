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
            $this->mysmarty->view('main/index');
        }
    }
