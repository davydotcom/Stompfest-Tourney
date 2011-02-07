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
                $this->NewTeam($_POST["tourneyID"]);
                break;

            case "L":
                $this->Freelance();
                break;
            }
        }

    function JoinTeam()
        {
        $this->load->model("tourney_gamer");

        $xA_Dude = array("userID" => $this->currentUser->userID,
                         "tourneyID" => $_POST["tourneyID"],
                         "lookingForTeam" => 1);

        $this->tourney_gamer->where($xA_Dude);

        $xDude = $this->tourney_gamer->first();
        if ( empty($xDude) )
            {
            $xA_Dude = array("teamID" => $_POST["teamID"],
                             "userID" => $this->currentUser->userID,
                             "tourneyID" => $_POST["tourneyID"]);

            $xDude = $this->tourney_gamer->create($xA_Dude);
            }
        else
            {
            $xA_Dude = array("teamID" => $_POST["teamID"],
                             "lookingForTeam" => 0);

            $xDude = $this->tourney_gamer->update($xDude->TTID, $xA_Dude);
            }

        if ( empty($xDude) )
            $this->Honk("Failed to join team.");
        else
            $this->GoodToGo("Successfully added to team.");
        }

    /**
     * This is from an AJAX call.
     * @param int $iTTID
     */
    function RemoveTeamMember($iTTID)
        {
        $this->load->model("tourney_gamer");

        $this->tourney_gamer->delete(array("TTID" => $iTTID));

        echo($iTTID);
        }

    function NewTeam($iTourneyID)
        {
        $this->load->model("tourney");

        $xTourney = $this->tourney->GetFullTourney($iTourneyID);

        $this->mysmarty->assign("Tourney", $xTourney);
        $this->mysmarty->view("/tourney/team/add");
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
            $this->Honk("Error saving Team information!");
            return;
            }

        $xA_Dude = array("userID" => $this->currentUser->userID,
                         "tourneyID" => $xA_Team["tourneyID"],
                         "lookingForTeam" => 1);

        $xDude = $this->tourney_gamer->first($xA_Dude);
        if ( empty($xDude) )
            {
            $xA_Dude = array("tourneyID" => $xA_Team["tourneyID"],
                             "teamID" => $xTeamID,
                             "userID" => $this->currentUser->userID);

            $xDude = $this->tourney_gamer->create($xA_Dude);
            }
        else
            {
            $xA_Dude = array("teamID" => $xTeamID,
                             "lookingForTeam" => 0);

            $xDude = $this->tourney_gamer->update($xDude->TTID, $xA_Dude);
            }

        if ( empty($xDude) )
            $this->Honk("Failed to place Gamer on Team");
        else
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

    /***
     * This is used in an AJAX call
     */
    function ValidateTeam()
        {
        $this->load->model("tourney_team");

        if ( $this->tourney_team->TeamExists($_POST["tourneyID"], $_POST["teamName"]) )
            {
            echo("Team already exists for this tournament");
            return;
            }

        echo("GOOD");
        }

    /***
     * This is used in an AJAX call
     */
    function SaveChanges()
        {
        $this->load->model("tourney_team");

        $xTeamID = $_POST["teamID"];
        if ( empty($xTeamID) )
            {
            echo("TeamID is required to save changes");
            return;
            }

        if ( $this->tourney_team->TeamExists($_POST["tourneyID"], $_POST["teamName"], $xTeamID) )
            {
            echo("Team already exists for this tournament");
            return;
            }

        $xA_Ass = array("teamURL" => $_POST["teamURL"],
                        "teamName" => $_POST["teamName"]);

        if ( empty($_POST["Captain"]) )
            {
            $xCapChanged = false;
            }
        else
            {
            $xCapChanged = true;
            $xA_Ass["captainID"] = $_POST["Captain"];
            }

        if ( !$this->tourney_team->update($xTeamID, $xA_Ass) )
            {
            echo("Failed to save team changes");
            return;
            }

        if ( $xCapChanged )
            echo("CAP");
        else
            echo("GOOD");
        }
    }
