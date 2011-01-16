<?php

require_once(APPPATH . "/models/sfmodel.php");

class Tourney extends SFModel
    {
    function __construct()
        {
        parent::__construct();
 
        $this->primaryKeyName = 'tourneyID';
        }

    function TeamsRegistered($iTourneyID)
        {
        $this->db->where("tourneyID", $iTourneyID);
        $this->db->from("tourney_teams");

        return $this->db->count_all_results();
        }
    }
