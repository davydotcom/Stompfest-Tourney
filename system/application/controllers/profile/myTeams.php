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

        if ( !empty($xA_Teams) )
            {
            foreach ( $xA_Teams as &$xI_Team )
                {
                $xI_Team->Members = $this->tourney_team->TeamMembers($xI_Team->teamID);
                $xI_Team->ReggyAt = $this->tourney->BuildRegistrationDates($xI_Team->registrationOpensAt, $xI_Team->registrationClosesAt);
                $xI_Team->IAmTeamCaptain = ($xI_Team->captainID == $this->currentUser->userID);
                }
            }

        $this->mysmarty->assign("MyTeams", $xA_Teams);
        $this->mysmarty->view("/profile/myTeams");
        }

    /**
     * This is used in an AJAX call
     *
     * @param <int> $iTTID tourney_gamers.TTID
     */
    function RemoveMe($iTTID)
        {
        $this->load->model("tourney_gamer");
        $this->tourney_gamer->delete(array("TTID" => $iTTID));

        echo("GOOD");
        }

    }
