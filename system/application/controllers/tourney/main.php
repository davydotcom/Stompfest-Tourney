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
        $this->load->model("tourney_gamer");

        $xNow = time();
        $xTourn = $this->tourney->GetList();

        foreach ( $xTourn as &$xI_Tourn )
            {
            switch ( $xI_Tourn->tourneyType )
                {
                case 0:
                    $xI_Tourn->Type = "Free For All";
                    break;

                case 1:
                    $xI_Tourn->Type = "Team Based";
                    $xI_Tourn->NumTeams = $this->tourney->TeamsRegistered($xI_Tourn->tourneyID);
                    break;

                case 2:
                    $xI_Tourn->Type = "1 vs 1";
                    break;
                }

            $xOpen = strtotime($xI_Tourn->registrationOpensAt);
            $xClos = strtotime($xI_Tourn->registrationClosesAt);

            if ( !empty($xOpen) )
                {
                $xI_Tourn->ReggyAt = date("n/j/Y @ g:i A", $xOpen);

                if ( !empty($xClos) )
                    $xI_Tourn->ReggyAt .= " - " . date("n/j/Y @ g:i A", $xClos);
                }

            if ( $this->isLoggedIn === false )
                {
                $xI_Tourn->Status = "";
                continue;
                }

            $xMyStat = $this->tourney_gamer->IAmRegistered($xI_Tourn->tourneyID);

            if ( !empty($xMyStat) )
                {
                if ( $xMyStat == 1 )
                    {
                    $xI_Tourn->Next = "R";
                    $xI_Tourn->Status = "Registered";
                    }
                else
                    {
                    $xI_Tourn->Next = "L";
                    $xI_Tourn->Status = "Looking for a Team";
                    }

                continue;
                }

            if ( $xNow < $xOpen )
                {
                $xI_Tourn->Status = "Opens at " . date("n/j/Y @ g:i A", $xOpen);
                continue;
                }

            if ( $xNow > $xClos )
                {
                $xI_Tourn->Status = "Closed";
                continue;
                }

            if ( !empty($xI_Tourn->maxTeams) && $xI_Tourn->NumTeams >= $xI_Tourn->maxTeams )
                {
                $xI_Tourn->Status = "<b>Full</b>";
                continue;
                }

            $xI_Tourn->Next = "O";
            $xI_Tourn->Status = "Open";
            }

        $this->mysmarty->view("tourney/main/index", array("Tourneys" => $xTourn));
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
                $this->mysmarty->view("/tourney/register/FFA");
                break;

            case 2:
                $this->mysmarty->view("/tourney/register/1v1");
                break;

            default:
                $this->load->model("tourney_team");

                $xA_Teams = $this->tourney_team->GetTeams($iTourneyID);

                $xA_Data = array("Teams" => $xA_Teams,
                                 "Tourney" => $xTourn,
                                 "NumTeams" => sizeof($xA_Teams));

                $this->mysmarty->view("/tourney/registration/Team", $xA_Data);
                break;
            }
        }

    function cancelReggy($iTourneyID)
        {
        $this->load->model("tourney_gamer");

        $this->tourney_gamer->delete(array("tourneyID" => $iTourneyID, "userID" => $this->currentUser->userID));

        $this->session->set_flashdata("notice", "Your registration has been canceled");

        $this->mysmarty->assign("UserData", $this->currentUser);
        $this->mysmarty->view("/profile/index");
        }
    }