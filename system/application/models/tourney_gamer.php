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
                        tourney_teams.*
                   FROM tourney_gamers
             INNER JOIN tourneys ON tourneys.tourneyID = tourney_gamers.tourneyID
              LEFT JOIN tourney_teams ON tourney_teams.teamID = tourney_gamers.teamID
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourney_gamers.userID = ? AND
                        tourneys.tourneyType = 1";

        $xQuery = $this->db->query($xSQL, array($this->currentUser->userID));
        if ( $xQuery->num_rows != 0 )
            $xA_Tourn = $xQuery->result();

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
    }
