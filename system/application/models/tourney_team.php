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
        $xSQL = "SELECT *
                   FROM tourney_teams
             INNER JOIN tourneys ON tourneys.tourneyID = tourney_teams.tourneyID
                  WHERE tourney_teams.eventID = ? AND
                        tourney_teams.tourneyID = ? AND
                        (tourneys.playersPerTeam = 0 OR
                         (SELECT COUNT(*) FROM tourney_gamers WHERE tourney_gamers.teamID = tourney_teams.teamID) < tourneys.playersPerTeam)";

        $xQuery = $this->db->query($xSQL, array($this->session->eventID, $iTourneyID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->result();
        }

    function TeamExists($iTourneyID, $iTeamName, $iTeamID = 0)
        {
        $xA_Cond = array("eventID" => $this->session->eventID, "tourneyID" => $iTourneyID, "teamName" => $iTeamName);

        if ( !empty($iTeamID) )
            $xA_Cond["teamID <>"] = $iTeamID;

        return $this->CanFind($xA_Cond);
        }

    function TeamMembers($iTeamID)
        {
        $xSQL = "SELECT users.*,
                        tourney_gamers.TTID,
                        (users.userID = ?) AS ThisIsMe,
                        EXISTS(SELECT *
                                 FROM tourney_teams
                                WHERE tourney_teams.teamID = tourney_gamers.teamID AND
                                      tourney_teams.tourneyID = tourney_gamers.tourneyID AND
                                      tourney_teams.captainID = tourney_gamers.userID) AS IsCaptain
                   FROM tourney_gamers
             INNER JOIN users ON users.userID = tourney_gamers.userID
                  WHERE tourney_gamers.teamID = ?
               ORDER BY IsCaptain DESC,
                        users.handle";

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
