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
        $xSQL = "SELECT tourney_gamers.*,
                        tourneys.name,
                        tourneys.tourneyType,
                        tourneys.description,
                        tourneys.endsAt,
                        tourneys.beginsAt,
                        tourneys.sponsoredBy,
                        games.name AS gameName,
                        games.short_name,
                        games.description AS gameDesc,
                        games.photo_file_name,
                        games.genre
                   FROM tourney_gamers
             INNER JOIN tourneys ON tourneys.tourneyID = tourney_gamers.tourneyID
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourney_gamers.userID = ?";

        $xQuery = $this->db->query($xSQL, array($this->currentUser->userID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->row();
        }
    }
