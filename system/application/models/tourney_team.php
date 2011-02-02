<?php

require_once(APPPATH . "/models/sfmodel.php");

class tourney_team extends SFModel
    {
    function __construct()
        {
        parent::__construct();
 
        $this->primaryKeyName = "teamID";
        }

    function GetTeams($iTourneyID)
        {
        $this->where(array("eventID" => $this->session->eventID, "tourneyID" => $iTourneyID));

        return $this->find();
        }

    function TeamExists($iTourneyID, $iTeamName)
        {
        return $this->CanFind(array("eventID" => $this->session->eventID, "tourneyID" => $iTourneyID, "teamName" => $iTeamName));
        }

    function TeamMembers($iTeamID)
        {
        $xSQL = "SELECT users.*,
                        tourney_gamers.TTID,
                        EXISTS(SELECT *
                                 FROM tourney_teams
                                WHERE tourney_teams.teamID = tourney_gamers.teamID AND
                                      tourney_teams.tourneyID = tourney_gamers.tourneyID AND
                                      tourney_teams.captainID = ?) AS IsCaptain
                   FROM tourney_gamers
             INNER JOIN users ON users.userID = tourney_gamers.userID
                  WHERE tourney_gamers.teamID = ?";

        $xQuery = $this->db->query($xSQL, array($this->currentUser->userID, $iTeamID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->result();
        }

    function IAmTeamCaptain($iTeamID)
        {
        return $this->CanFind(array("teamID" => $iTeamID, "captainID" => $this->currentUser->userID));
        }
    }
