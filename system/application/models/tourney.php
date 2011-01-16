<?php

require_once(APPPATH . "/models/sfmodel.php");

class Tourney extends SFModel
    {
    function __construct()
        {
        parent::__construct();
 
        $this->primaryKeyName = 'tourneyID';
        }

    function GetFullTourney($iTourneyID)
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

    function TeamsRegistered($iTourneyID)
        {
        $this->db->where("tourneyID", $iTourneyID);
        $this->db->from("tourney_teams");

        return $this->db->count_all_results();
        }
    }
