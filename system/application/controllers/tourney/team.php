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
        $this->load->model("user_news");
        $this->load->model("tourney_team");
        $this->load->model("tourney_gamer");
        $this->load->model("tourney_invite");

        $xA_Dude = array("userID" => $this->currentUser->userID,
                         "tourneyID" => $_POST["tourneyID"],
                         "lookingForTeam" => 1);

        $xDude = $this->tourney_gamer->first($xA_Dude);
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
            {
            $this->Honk("Failed to join team.");
            return;
            }

        $xTeam = $this->tourney_team->first(array("teamID" => $_POST["teamID"]));

        if ( !empty($xTeam->captainID) )
            {
            $xMess = sprintf("!TOUR!: %s <small>(%s)</small> has joined team <b>!TEAM!</b>.", $this->currentUser->handle, $this->currentUser->userID);
            $this->user_news->AddNews($xTeam->captainID, $xMess, $_POST["tourneyID"], $_POST["teamID"]);
            }

        $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: Joined team <b>!TEAM!</b>.", $_POST["tourneyID"], $_POST["teamID"]);
        $this->touney_invite->delete(array("tourneyID" => $_POST["tourneyID"], "userID" => $this->currentUser->userID));

        $this->GoodToGo("Successfully added to team.");
        }

    /**
     * This is from an AJAX call.
     * @param int $iTTID
     */
    function RemoveTeamMember($iTTID)
        {
        $this->load->model("user_news");
        $this->load->model("tourney_gamer");

        $xTG = $this->tourney_gamer->first(array("TTID" => $iTTID));
        if ( !empty($xTG) )
            {
            $this->user_news->AddNews($xTG->userID, "!TOUR!: You have been removed from team <b>!TEAM!</b>.", $xTG->tourneyID, $xTG->teamID);

            $this->tourney_gamer->delete(array("TTID" => $iTTID));
            }

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
                         "comments" => $_POST["comments"],
                         "tourneyID" => $_POST["tourneyID"],
                         "lookingForTeam" => 1);

        $xDude = $this->tourney_gamer->create($xA_Dude);

        if ( empty($xDude) )
            {
            $this->Honk("Failed to place Gamer as a freelance player.");
            return;
            }

        $this->load->model("user_news");

        $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: Marked as looking for a team", $_POST["tourneyID"]);
        $this->GoodToGo("Successfully added as a freelance player.");
        }

    function saveNew()
        {
        $this->load->model("user_news");
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
            {
            $this->Honk("Failed to place Gamer on Team");
            }
        else
            {
            $this->user_news->AddNews($this->currentUser->userID, sprintf("!TOUR!: Team created: <b>%s</b>.", $xA_Team["teamName"]), $xA_Team["tourneyID"]);
            $this->GoodToGo("Team successfully created and registered for the Tournament.");
            }
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
        $this->load->model("user_news");
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
            {
            $this->user_news->AddNews($this->currentUser->userID, sprintf("!TOUR!: Removed yourself as team captain of <b>%s</b>.", $_POST["teamName"]), $_POST["tourneyID"]);
            $this->user_news->AddNews($xA_Ass["captainID"], sprintf("!TOUR!: You've been made team captain of <b>%s</b>.", $_POST["teamName"]), $_POST["tourneyID"]);

            echo("CAP");
            }
        else
            {
            echo("GOOD");
            }
        }

    function Disband($iTourneyID, $iTeamID)
        {
        $this->load->model("user_news");
        $this->load->model("tourney_team");
        $this->load->model("tourney_gamer");

        $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: Disbanded team <b>%s</b>.", $iTourneyID, $iTeamID);

        $this->tourney_team->delete(array("teamID" => $iTeamID));
        $this->tourney_gamer->delete(array("teamID" => $iTeamID));

        redirect("/tourney/main");
        }

    function GetPickupPlayers($iTourneyID)
        {
        $this->load->model("tourney_gamer");

        $xLookers = $this->tourney_gamer->GetGamersLooking($iTourneyID);
        if ( empty($xLookers) )
            {
            echo("");
            return;
            }

        $xList = "";
        $xTemp = '<tr valign="top"><td align="center"><input id="xPUDude_%USERID%" name="xPUDude_%USERID%" type="checkbox" title="Invite \'%HAND%\' to my team" value="%HAND%" /></td><td><b><label for="xPUDude_%USERID%">%HAND%</label></b></td><td><textarea cols="50" readonly="readonly">%COMM%</textarea></td></tr>';
        $xA_UID = array();

        foreach ( $xLookers as $xDude )
            {
            $xNew = str_replace("%COMM%", $xDude->comments, $xTemp);
            $xNew = str_replace("%USERID%", $xDude->userID, $xNew);
            $xA_UID[] = $xDude->userID;

            $xList .= str_replace("%HAND%", $xDude->handle, $xNew);
            }

        $xDude = new stdClass();
        $xDude->Data = $xA_UID;
        $xDude->HTML =  $xList;
        $xDude->tourneyID = $iTourneyID;

        echo(json_encode($xDude));
        }

    function InvitePlayers()
        {
        $this->load->model("user_news");
        $this->load->model("tourney_invite");

        $xTeamID = $_POST["xTeamID"];
        $xA_Picks = split(",", $_POST["xPicks"]);
        $xTourneyID = $_POST["xTourneyID"];

        foreach ( $xA_Picks as $xUserID )
            {
            $this->user_news->AddNews($xUserID, "!TOUR!: You have been invited to join Team <b>!TEAM!</b>.", $xTourneyID, $xTeamID);
            $this->tourney_invite->create(array("tourneyID" => $xTourneyID, "userID" => $xUserID, "teamID" => $xTeamID));
            }

        echo("GOOD");
        }

    function InviteAccept($iTourneyID, $iTeamID)
        {
        }
    }
