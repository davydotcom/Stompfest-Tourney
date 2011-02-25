<?php

require_once(APPPATH . "/controllers/application.php");

class MyTourney extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();

        require_once(APPPATH . "/controllers/tourney/helpers.php");
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

                    if ( $xI_Tourn->IAmTeamCaptain &&
                         !empty($xI_Tourn->playersPerTeam) &&
                         sizeof($xI_Tourn->Members) < $xI_Tourn->playersPerTeam &&
                         $this->tourney_gamer->GamersAreLookingForTeam($xI_Tourn->tourneyID) )
                        {
                        $xI_Tourn->ShowLooking = true;
                        }
                    else
                        {
                        $xI_Tourn->ShowLooking = false;
                        }
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
        $this->load->model("user_news");
        $this->load->model("tourney_gamer");

        $xTG = $this->tourney_gamer->first(array("TTID" => $iTTID));
        if ( !empty($xTG) )
            {
            if ( $xTG->teamID == 0 )
                $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: No longer looking for a Team.", $xTG->tourneyID);
            else
                $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: Drop out Team <b>!TEAM!</b>.", $xTG->tourneyID, $xTG->teamID);
            }

        $this->tourney_gamer->delete(array("TTID" => $iTTID));

        echo("GOOD");
        }

    function dropOut($iTourneyID)
        {
        $this->load->model("tourney_gamer");

        $this->tourney_gamer->delete(array("tourneyID" => $iTourneyID, "userID" => $this->currentUser->userID));
        }

    /**
     * This is used in an AJAX call
     */
    function SaveLooking()
        {
        $this->load->model("tourney_gamer");

        if ( $this->tourney_gamer->update($_POST["TTID"], array("comments" => $_POST["Comment"])) )
            echo("GOOD");
        else
            echo("Failed to update Gamer record");
        }
    }
