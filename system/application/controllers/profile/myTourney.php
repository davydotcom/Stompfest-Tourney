<?php

require_once(APPPATH . "/controllers/application.php");

class MyTourney extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();
        }

    function index()
        {
        }
    }
