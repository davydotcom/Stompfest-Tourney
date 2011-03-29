<?php

require_once(APPPATH . "/controllers/application.php");

class Main extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        require_once(APPPATH . "/controllers/tourney/helpers.php");
        }

    function index($iMineOnly = false)
        {
        $this->load->model("tourney");

        $xType = null;
        $xA_Tourn = array();

        if ( Core::GetBool($this->isLoggedIn) )
            {
            $this->load->model("tourney_team");
            $this->load->model("tourney_gamer");

            $xA_Mine = $this->tourney_gamer->GetMyTourneys();
            if ( !empty($xA_Mine) )
                {
                foreach ( $xA_Mine as $xI_Mine )
                    {
                    $xI_Mine->ReggyAt = $this->tourney->BuildRegistrationDates($xI_Mine->registrationOpensAt, $xI_Mine->registrationClosesAt);

                    $xA_Tourn[$xI_Mine->tourneyID] = $xI_Mine;
                    }
                }

            $this->mysmarty->assign("UserData", $this->currentUser);
            }

        if ( !Core::GetBool($iMineOnly) )
            {
            $xA_All = $this->tourney->GetList();

            foreach ( $xA_All as $xI_All )
                {
                if ( array_key_exists($xI_All->tourneyID, $xA_Tourn) )
                    continue;

                $xI_All->ReggyAt = $this->tourney->BuildRegistrationDates($xI_All->registrationOpensAt, $xI_All->registrationClosesAt);
                $xA_Tourn[] = $xI_All;
                }
            }

        if ( Core::GetBool($iMineOnly) && Core::GetBool($this->isLoggedIn) )
            $xType = "User";
        else
            $xType = "Tourn";

        $this->mysmarty->assign("ListType", $xType);
        $this->mysmarty->assign("Tourneys", array_values($xA_Tourn));
        $this->mysmarty->view("/tourney/main/index");
        }

    function view($iTourneyID)
        {
        $this->load->model("tourney");
        $this->load->model("tourney_gamer");

        $xTourney = $this->tourney->GetFullTourney($iTourneyID);

        $xOpen = strtotime($xTourney->registrationOpensAt);
        $xClos = strtotime($xTourney->registrationClosesAt);
        $xTourney->Status = "";
        $xTourney->ReggyAt = $this->tourney->BuildRegistrationDates($xOpen, $xClos);

        switch ( $xTourney->tourneyType )
            {
            case 0:
                $xTourney->TypeDesc = "Free For All";
                break;

            case 1:
                $xTourney->NumTeams = $this->tourney->TeamsRegistered($xTourney->tourneyID);
                $xTourney->TypeDesc = "Team Based";
                break;

            case 2:
                $xTourney->TypeDesc = "1 vs 1";
                break;
            }

        if ( $this->isLoggedIn === true )
            {
            $xNow = time();
            $xMyStat = $this->tourney_gamer->IAmRegistered($iTourneyID);

            if ( !empty($xMyStat) )
                {
                if ( $xMyStat == 1 )
                    {
                    $this->load->model("tourney_invite");

                    $xTourney->Next = "R";
                    $xTourney->Status = "Registered";
                    $xTourney->Invites = $this->tourney_invite->GetMyInvites($xTourney->tourneyID);
                    $xTourney->Members = $this->tourney_team->TeamMembers($xTourney->teamID);
                    $xTourney->IAmTeamCaptain = ($xTourney->captainID == $this->currentUser->userID);

                    if ( $xTourney->IAmTeamCaptain &&
                         !empty($xTourney->playersPerTeam) &&
                         sizeof($xTourney->Members) < $xTourney->playersPerTeam &&
                         $this->tourney_gamer->GamersAreLookingForTeam($xTourney->tourneyID) )
                        {
                        $xTourney->ShowLooking = true;
                        }
                    else
                        {
                        $xTourney->ShowLooking = false;
                        }
                    }
                else
                    {
                    $xTourney->Next = "L";
                    $xTourney->Status = "Looking for a Team";
                    }
                }

            if ( $xTourney->Status == "" && $xNow < $xOpen )
                $xTourney->Status = "Opens at " . date("n/j/Y @ g:i A", $xOpen);

            if ( $xTourney->Status == "" && $xNow > $xClos )
                $xTourney->Status = "Closed";

            if ( $xTourney->Status == "" && !empty($xTourney->maxTeams) && $xTourney->NumTeams >= $xTourney->maxTeams )
                $xTourney->Status = "<b>Full</b>";

            if ( $xTourney->Status == "" )
                {
                $xTourney->Next = "O";
                $xTourney->Status = "Open";
                }
            }

        $this->mysmarty->assign("xTourney", $xTourney);

        return $this->mysmarty->view("/tourney/components/tourney");
        }

    function FoundTeam($iTourneyID)
        {
        $this->load->model("tourney");

        $xTourn = $this->tourney->GetFullTourney($iTourneyID);
        if ( empty($xTourn) )
            {
            $this->index();
            return;
            }

        $this->load->model("tourney_team");

        $xA_Teams = $this->tourney_team->GetTeams($iTourneyID);

        $xA_Data = array("Teams" => $xA_Teams,
                         "Options" => 0,
                         "Tourney" => $xTourn,
                         "NumTeams" => sizeof($xA_Teams));

        $this->mysmarty->view("/tourney/registration/Team", $xA_Data);
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
                                 "Options" => 1,
                                 "Tourney" => $xTourn,
                                 "NumTeams" => sizeof($xA_Teams));

                $this->mysmarty->view("/tourney/registration/Team", $xA_Data);
                break;
            }
        }

    function cancelReggy($iTourneyID, $iTTID)
        {
        $this->load->model("user_news");
        $this->load->model("tourney_gamer");

        $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: Canceled registration", $iTourneyID);
        $this->tourney_gamer->delete(array("TTID" => $iTTID));

        $this->session->set_flashdata("notice", "Your registration has been canceled");

        redirect("/profile/main");
        }
    }