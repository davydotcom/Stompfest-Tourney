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
        $this->where(array("eventID" => $this->session->eventID, "tourneyID" => $iTourneyID));

        return $this->find();
        }
    }
