<?php

require_once(APPPATH . "/models/sfmodel.php");

class tourney_invite extends SFModel
    {
    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = "inviteID";
        }

    function GetMyInvites($iTourneyID)
        {
        $xSQL = "SELECT tourney_invites.*,
                        tourney_teams.teamName,
                        tourney_teams.teamURL,
                        tourney_teams.teamIcon,
                        tourney_teams.captainID,
                        users.handle
                   FROM tourney_invites
             INNER JOIN tourney_teams ON tourney_teams.teamID = tourney_invites.teamID
             INNER JOIN users ON users.userID = tourney_teams.captainID
                  WHERE tourney_invites.tourneyID = ? AND
                        tourney_invites.userID = ?";

        $xQuery = $this->db->query($xSQL, array($iTourneyID, $this->currentUser->userID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->result();
        }
    }
