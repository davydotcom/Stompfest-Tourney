<?php

require_once(APPPATH . "/models/sfmodel.php");

class Tourney extends SFModel
    {
    function __construct()
        {
        parent::__construct();
 
        $this->primaryKeyName = "tourneyID";
        }

    function GetList()
        {
        $xSQL = "SELECT IF(tourneys.name IS NULL, games.name, tourneys.name) AS showName,
                        tourneys.tourneyID,
                        tourneys.registrationOpensAt,
                        tourneys.registrationClosesAt,
                        games.photo_file_name
                   FROM tourneys
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourneys.eventID = ? AND
                        games.active = 1";

        $xQuery = $this->db->query($xSQL, array($this->session->eventID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->result();
        }

    function GetFullTourney($iTourneyID)
        {
        $xTourney = $this->findByID($iTourneyID);
        if ( $xTourney == null )
            return null;

        if ( $xTourney->tourneyType == 1 )      //  Team based
            {
            if ( !empty($this->currentUser) )
                {
                $xSQL = "SELECT tourney_gamers.*,
                                tourneys.*,
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
                                tourneys.tourneyID = ?";

                $xQuery = $this->db->query($xSQL, array($this->currentUser->userID, $iTourneyID));
                if ( $xQuery->num_rows != 0 )
                    return $xQuery->row();
                }

            $xSQL = "SELECT tourneys.*,
                            IF(tourneys.name IS NULL, games.name, tourneys.name) AS showName
                       FROM tourneys
                 INNER JOIN games ON games.gameID = tourneys.gameID
                      WHERE tourneys.tourneyID = ?";

            $xQuery = $this->db->query($xSQL, array($iTourneyID));
            if ( $xQuery->num_rows == 0 )
                return null;

            return $xQuery->row();
            }

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
                        tourneys.tourneyID = ?";
        $xQuery = $this->db->query($xSQL, array($this->currentUser->userID, $iTourneyID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->row();
        }

    function TeamsRegistered($iTourneyID)
        {
        $this->db->where("tourneyID", $iTourneyID);
        $this->db->from("tourney_teams");

        return $this->db->count_all_results();
        }

    function BuildRegistrationDates($iBegAt, $iEndAt)
        {
        if ( empty($iBegAt) )
            return null;

        if ( !is_numeric($iBegAt) )
            $iBegAt = strtotime($iBegAt);

        $xDate = date("n/j/Y @ g:i A", $iBegAt);

        if ( !empty($iEndAt) )
            {
            if ( !is_numeric($iEndAt) )
                $iEndAt = strtotime($iEndAt);

            $xDate .= " - " . date("n/j/Y @ g:i A", $iEndAt);
            }

        return $xDate;
        }
    }
