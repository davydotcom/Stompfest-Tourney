<?php

require_once(APPPATH . "/controllers/application.php");

class MyTeams extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();
        }

    function index()
        {
        $this->load->model("tourney_gamer");

        $this->mysmarty->assign("MyTeams", $this->tourney_gamer->GetMyTourneys(true));
        $this->mysmarty->view('/profile/myTeams');
        }
    }
