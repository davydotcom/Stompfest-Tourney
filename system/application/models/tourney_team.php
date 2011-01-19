<?php

require_once(APPPATH . "/models/sfmodel.php");

class tourney_team extends SFModel
    {
    function __construct()
        {
        parent::__construct();
 
        $this->primaryKeyName = "teamID";
       }

    function GetTeams()
        {
        return $this->find();
        }

    function GetMyTeams()
        {
        $xSQL = "SELECT *
                   FROM tourneys
             INNER JOIN games ON games.gameID = tourneys.gameID
                  WHERE tourneys.tourneyID = ?";

        $xQuery = $this->db->query($xSQL, array($iTourneyID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->row();
        }
    }
