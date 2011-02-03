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
        $this->load->model("tourney");
        $this->load->model("tourney_team");
        $this->load->model("tourney_gamer");

        $xA_Tourn = $this->tourney_gamer->GetMyTourneys();

        if ( !empty($xA_Tourn) )
            {
            foreach ( $xA_Tourn as &$xI_Tourn )
                {
                if ( $xI_Tourn->tourneyType == 1 )
                    {
                    $xI_Tourn->Members = $this->tourney_team->TeamMembers($xI_Tourn->teamID);
                    $xI_Tourn->IAmTeamCaptain = ($xI_Tourn->captainID == $this->currentUser->userID);
                    }

                $xI_Tourn->ReggyAt = $this->tourney->BuildRegistrationDates($xI_Tourn->registrationOpensAt, $xI_Tourn->registrationClosesAt);
                }
            }

        $this->mysmarty->assign("MyTourneys", $xA_Tourn);
        $this->mysmarty->view("/profile/myTourney");
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

    function dropOut($iTourneyID)
        {
        $this->load->model("tourney_gamer");

        $this->tourney_gamer->delete(array("tourneyID" => $iTourneyID, "userID" => $this->currentUser.userID));
        }
    }
