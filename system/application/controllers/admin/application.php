<?php
require_once(APPPATH . "/controllers/application.php");
class AdminApplicationController extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

                $this->requireAdministrator();
        }

    function requireAdministrator()
    {

    }
    }
