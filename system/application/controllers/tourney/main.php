<?php

require_once(APPPATH . "/controllers/application.php");

class Main extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();
        }

    function index()
        {
        $this->load->model("tourney");

        $xNow = time();
        $xTourn = $this->tourney->GetList();

        foreach ( $xTourn as &$xI_Tourn )
            {
            if ( $this->isLoggedIn === false )
                {
                $xI_Tourn->Status = "";
                continue;
                }

            if ( $this->IAmRegistered($xI_Tourn->tourneyID) )
                {
                $xI_Tourn->Status = "";
                continue;
                }

            $xOpen = strtotime($xI_Tourn->registrationOpensAt);
            $xClos = strtotime($xI_Tourn->registrationClosesAt);

            if ( $xNow < $xOpen )
                {
                $xI_Tourn->Status = "Opens at " . date("j/n/Y @ g:i A", $xOpen);
                continue;
                }

            if ( $xNow > $xClos )
                {
                $xI_Tourn->Status = "Closed";
                continue;
                }

            if ( !empty($xI_Tourn->maxTeams) && $xI_Tourn->maxTeams >= $this->tourney->TeamsRegistered($xI_Tourn->tourneyID) )
                {
                $xI_Tourn->Status = "<b>Full</b>";
                continue;
                }

            $xI_Tourn->Status = sprintf('<a href="/tourney/main/register/%s">Register</a>', $xI_Tourn->tourneyID);
            }

        $this->mysmarty->view("tourney/main/index", array("Tourneys" => $xTourn));
        }

    function IAmRegistered($iTournyID)
        {
        if ( $this->isLoggedIn === false )
            return false;

        $this->load->model("tourney_gamer");

        return $this->tourney_gamer->CanFind(array("tourneyID" => $iTournyID, "userID" => $this->currentUser->userID));
        }

    function register($iTourneyID)
        {
        $this->load->model("tourney");

        $xTourn = $this->tourney->GetFullTourney($iTourneyID);
        if ( empty($xTourn) )
            {
            $this->index();
            return;
            }

        switch ( $xTourn->tourneyType )
            {
            case 0:
                $this->mysmarty->view("tourney/register/FFA");
                break;

            case 2:
                $this->mysmarty->view("tourney/register/1v1");
                break;

            default:
                $this->load->model("tourney_team");

                $xA_Teams = $this->tourney_team->GetTeams();

                $xA_Data = array("Teams" => $xA_Teams,
                                 "Tourney" => $xTourn,
                                 "NumTeams" => sizeof($xA_Teams));

                $this->mysmarty->view("tourney/registration/Team", $xA_Data);
                break;
            }
        }

    }