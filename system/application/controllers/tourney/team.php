<?php

require_once(APPPATH . "/controllers/application.php");

class Team extends ApplicationController
    {
    function DoIt()
        {
        switch( $_POST["xDoWhat"] )
            {
            case "T":
                $this->JoinTeam();
                break;

            case "N":
                $this->NewTeam();
                break;

            case "L":
                $this->Freelance();
                break;
            }
        }

    function JoinTeam()
        {
        $this->load->model("tourney_gamer");

        $xA_Dude = array("teamID" => $_POST["teamID"],
                         "userID" => $this->currentUser->userID,
                         "tourneyID" => $_POST["tourneyID"]);

        $xDude = $this->tourney_gamer->create($xA_Dude);

        if ( empty($xDude) )
            $this->Honk("Failed to place Gamer as a freelance player.");
        else
            $this->GoodToGo("Successfully added as a freelance player.");
        }

    function NewTeam()
        {
        $this->load->model("tourney");

        $xTourney = $this->tourney->findByID($_POST["tourneyID"]);

        $this->mysmarty->view("/tourney/team/add", array("Tourney" => $xTourney));
        }

    function Freelance()
        {
        $this->load->model("tourney_gamer");

        $xA_Dude = array("teamID" => 0,
                         "userID" => $this->currentUser->userID,
                         "tourneyID" => $_POST["tourneyID"],
                         "lookingForTeam" => 1);

        $xDude = $this->tourney_gamer->create($xA_Dude);

        if ( empty($xDude) )
            $this->Honk("Failed to place Gamer as a freelance player.");
        else
            $this->GoodToGo("Successfully added as a freelance player.");
        }

    function saveNew()
        {
        $this->load->model("tourney_team");
        $this->load->model("tourney_gamer");

        $xA_Team = $_POST;
        $xA_Team["eventID"] = $this->session->eventID;
        $xA_Team["captainID"] = $this->currentUser->userID;

        $xTeamID = $this->tourney_team->create($xA_Team);
        if ( empty($xTeamID) )
            {
            $this->Honk("Error saving Team information!.");
            return;
            }

        $xA_Dude = array("tourneyID" => $xA_Team["tourneyID"],
                         "teamID" => $xTeamID,
                         "userID" => $this->currentUser->userID);

        $xDude = $this->tourney_gamer->create($xA_Dude);

        if ( empty($xDude) )
            $this->Honk("Failed to place Gamer on Team");

        $this->GoodToGo("Team successfully created and registered for the Tournament.");
        }

    function Honk($iMessage)
        {
        $this->session->set_flashdata('error', $iMessage);
        redirect("/profile/main");
        }

    function GoodToGo($iMessage)
        {
        $this->session->set_flashdata("notice", $iMessage);
        redirect("/profile/main");
        }
    }
