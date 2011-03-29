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
        $xSQL = "SELECT tourneys.tourneyID,
                        IF(tourneys.name IS NULL, games.name, tourneys.name) AS ShowName,
                        games.photo_file_name,
                        tourneys.registrationOpensAt,
                        tourneys.registrationClosesAt
                   FROM tourney_gamers
             INNER JOIN tourneys ON tourneys.tourneyID = tourney_gamers.tourneyID
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourney_gamers.userID = ?";

        $xQuery = $this->db->query($xSQL, array($this->currentUser->userID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->result();
        }

    function IAmRegistered($iTourneyID)
        {
        if ( $this->isLoggedIn === false )
            return 0;

        $xDude = $this->first(array("tourneyID" => $iTourneyID, "userID" => $this->currentUser->userID));
        if ( empty($xDude) )
            return 0;

        if ( $xDude->lookingForTeam == 0 )
            return 1;

        return 2;
        }

    function GamersAreLookingForTeam($iTourneyID)
        {
        $xSQL = "SELECT *
                   FROM tourney_gamers
                  WHERE tourney_gamers.lookingForTeam = 1 AND
                        tourney_gamers.tourneyID = ? AND
                        NOT EXISTS(SELECT *
                                     FROM tourney_invites
                                    WHERE tourney_invites.userID = tourney_gamers.userID AND
                                          tourney_invites.tourneyID = tourney_gamers.tourneyID)
                  LIMIT 1";

        $xQuery = $this->db->query($xSQL, array($iTourneyID));

        return ($xQuery->num_rows != 0);
        }

    function GetGamersLooking($iTourneyID)
        {
        $xSQL = "SELECT tourney_gamers.TTID,
                        tourney_gamers.comments,
                        users.handle,
                        users.userID
                   FROM tourney_gamers
             INNER JOIN users ON users.userID = tourney_gamers.userID
                  WHERE tourney_gamers.tourneyID = ? AND
                        tourney_gamers.lookingForTeam = 1 AND
                        NOT EXISTS(SELECT *
                                     FROM tourney_invites
                                    WHERE tourney_invites.userID = tourney_gamers.userID AND
                                          tourney_invites.tourneyID = tourney_gamers.tourneyID)";

        $xQuery = $this->db->query($xSQL, array($iTourneyID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->result();
        }
    }
