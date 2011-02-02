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
        $this->load->model("tourney");
        $this->load->model("tourney_team");
        $this->load->model("tourney_gamer");

        $xA_Teams = $this->tourney_gamer->GetMyTourneys(1);

        foreach ( $xA_Teams as &$xI_Team )
            {
            $xI_Team->Members = $this->tourney_team->TeamMembers($xI_Team->teamID);
            $xI_Team->ReggyAt = $this->tourney->BuildRegistrationDates($xI_Team->registrationOpensAt, $xI_Team->registrationClosesAt);
            $xI_Team->IAmTeamCaptain = $this->tourney_team->IAmTeamCaptain($xI_Team->teamID);
            }

        $this->mysmarty->assign("MyTeams", $xA_Teams);
        $this->mysmarty->view("/profile/myTeams");
        }
    }
