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
        $xTourn = $this->tourney->find();

        foreach ( $xTourn as &$xI_Tourn )
            {
            if ( $this->isLoggedIn &&
                 $xNow >= strtotime($xI_Tourn->registrationOpensAt) &&
                 $xNow <= strtotime($xI_Tourn->registrationClosesAt) )
                {
                if ( $this->IAmRegistered($xI_Tourn->tourneyID) )
                    {
                    $xI_Tourn->Status = "";
                    }
                else
                    {
                    if ( !empty($xI_Tourn->maxTeams) && $xI_Tourn->maxTeams >= $this->tourney->TeamsRegistered($xI_Tourn->tourneyID) )
                        {
                        $xI_Tourn->Status = "<b>Full</b>";
                        }
                    else
                        {
                        $xI_Tourn->Status = sprintf('<a href="/tourney/main/register/%s">Register</a>', $xI_Tourn->tourneyID);
                        }
                    }
                }
            }

        $this->mysmarty->view("tourney/main/index", array("Tourneys" => $xTourn));
        }

    function IAmRegistered($iTournyID)
        {
        if ( $this->isLoggedIn === false )
            return false;

        $this->load->model("tourney");

        return !$this->tourney->CanFind(array("tourneyID" => $iTournyID, "userID" => $this->currentUser->userID));
        }

    function register($iTourneyID)
        {
        $this->load->model("tourney");

        $xTourn = $this->tourney->findByID($iTourneyID);
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