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
        $xSQL = "SELECT games.description AS gameDesc,
                        games.short_name,
                        games.genre,
                        games.parentGameID,
                        games.photo_file_name,
                        games.active,
                        IF(tourneys.name IS NULL, games.name, tourneys.name) AS showName,
                        tourneys.*
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
        $xSQL = "SELECT games.description AS gameDesc,
                        games.short_name,
                        games.genre,
                        games.parentGameID,
                        games.photo_file_name,
                        games.active,
                        IF(tourneys.name IS NULL, games.name, tourneys.name) AS showName,
                        tourneys.*
                   FROM tourneys
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourneys.tourneyID = ?";

        $xQuery = $this->db->query($xSQL, array($iTourneyID));
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
