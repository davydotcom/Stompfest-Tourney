<?php

require_once(APPPATH . "/models/sfmodel.php");

class tourney_gamer extends SFModel
    {
    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = "TTID";
        }

    function GetMyTourneys()
        {
        //  Build a list of Team-based Tourneys
        $xA_Tourn = null;
        $xSQL = "SELECT tourney_gamers.*,
                        tourneys.tourneyType,
                        tourneys.description,
                        tourneys.endsAt,
                        tourneys.beginsAt,
                        tourneys.playersPerTeam,
                        tourneys.registrationOpensAt,
                        tourneys.registrationClosesAt,
                        tourneys.sponsoredBy,
                        IF(tourneys.name IS NULL, games.name, tourneys.name) AS showName,
                        games.short_name,
                        games.description AS gameDesc,
                        games.photo_file_name,
                        games.genre,
                        tourney_teams.teamID,
                        tourney_teams.teamName,
                        tourney_teams.teamURL,
                        tourney_teams.teamIcon,
                        tourney_teams.captainID,
                        tourney_teams.locked,
                        tourney_teams.readyForMatch,
                        tourney_teams.currentTier
                   FROM tourney_gamers
             INNER JOIN tourneys ON tourneys.tourneyID = tourney_gamers.tourneyID
              LEFT JOIN tourney_teams ON tourney_teams.teamID = tourney_gamers.teamID
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourney_gamers.userID = ? AND
                        tourneys.tourneyType = 1";

        $xQuery = $this->db->query($xSQL, array($this->currentUser->userID));
        if ( $xQuery->num_rows != 0 )
            $xA_Tourn = $xQuery->result();

        //  Get all other Tourneys
        $xSQL = "SELECT tourney_gamers.*,
                        tourneys.tourneyType,
                        tourneys.description,
                        tourneys.endsAt,
                        tourneys.beginsAt,
                        tourneys.playersPerTeam,
                        tourneys.registrationOpensAt,
                        tourneys.registrationClosesAt,
                        tourneys.sponsoredBy,
                        IF(tourneys.name IS NULL, games.name, tourneys.name) AS showName,
                        games.short_name,
                        games.description AS gameDesc,
                        games.photo_file_name,
                        games.genre
                   FROM tourney_gamers
             INNER JOIN tourneys ON tourneys.tourneyID = tourney_gamers.tourneyID
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourney_gamers.userID = ? AND
                        tourneys.tourneyType <> 1";

        $xQuery = $this->db->query($xSQL, array($this->currentUser->userID));
        if ( $xQuery->num_rows != 0 )
            $xA_Tourn = array_merge($xA_Tourn, $xQuery->result());

        return $xA_Tourn;
        }

    function IAmRegistered($iTourneyID)
        {
        if ( $this->isLoggedIn === false )
            return 0;

        $this->where(array("tourneyID" => $iTourneyID, "userID" => $this->currentUser->userID));
        $xDude = $this->first();

        if ( empty($xDude) )
            return 0;

        if ( $xDude->lookingForTeam == 0 )
            return 1;

        return 2;
        }

    function GamersAreLookingForTeam($iTourneyID)
        {
        return $this->CanFind(array("tourneyID" => $iTourneyID, "lookingForTeam" => 1));
        }

    function GetGamersLooking($iTourneyID)
        {
        return $this->find(array("tourneyID" => $iTourneyID, "lookingForTeam" => 1));
        }
    }
