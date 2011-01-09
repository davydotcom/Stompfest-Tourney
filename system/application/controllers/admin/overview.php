<?php
require_once(APPPATH . "/controllers/admin/application.php");
class Main extends AdminApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->load->library('session');
        }

    function index()
        {
            $this->mysmarty->view('admin/overview/index');
        }
    }
