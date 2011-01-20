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
        $this->load->model("tourney_gamer");

        $this->mysmarty->assign("MyTeams", $this->tourney_gamer->GetMyTourneys());
        $this->mysmarty->view("/profile/myTourney");
        }

    function dropOut($iTourneyID)
        {
        $this->load->model("tourney_gamer");

        $this->tourney_gamer->delete(array("tourneyID" => $iTourneyID, "userID" => $this->currentUser.userID));
        }
    }
