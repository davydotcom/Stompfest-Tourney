<?php
require_once(APPPATH . "/models/sfmodel.php");

class User_News extends SFModel
    {
    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = "newsID";
        }

    function GetMyNews()
        {
        $xSQL = "SELECT newsID,
                        userID,
                        message,
                        DATE_FORMAT(sentAt, '%m/%d/%Y @ %l:%i %p') AS sentAt
                   FROM user_news
                  WHERE userID = ?
               ORDER BY sentAt DESC";
        $xQuery = $this->db->query($xSQL, array("userID" => $this->currentUser->userID));
        if ( $xQuery->num_rows == 0 )
            return null;

        return $xQuery->result();
        }   

    function AddNews($iToUserID, $iMessage, $iTourneyID = null, $iTeam = null)
        {
        if ( !empty($iTourneyID) && strpos($iMessage, "!TOUR!") !== false )
            {
            $xSQL = "SELECT IF(tourneys.name IS NULL, games.name, tourneys.name) AS showName,
                       FROM tourneys
                 INNER JOIN games ON games.gameID = tourneys.gameID
                      WHERE tourneys.tourneyID = ?";

            $xQuery = $this->db->query($xSQL, array($iTourneyID));
            if ( $xQuery->num_rows == 0 )
                $iMessage = str_replace("!TOUR!", "", $iMessage);
            else
                $iMessage = str_replace("!TOUR!", $xQuery->row()->showName, $iMessage);
            }

        if  ( !empty($iTeamID) && strpos($iMessage, "!TEAM!") !== false )
            {
            $xSQL = "SELECT teamName FROM tourney_teams WHERE teamID = ?";
            $xQuery = $this->db->query($xSQL, array($iTeamID));

            if ( $xQuery->num_rows == 0 )
                $iMessage = str_replace("!TEAM!", "", $iMessage);
            else
                $iMessage = str_replace("!TEAM!", $xQuery->row()->teamName, $iMessage);
            }

        return $this->create(array("userID" => $iToUserID, "message" => $iMessage));
        }

    function DeleteItem($iNewsID)
        {
        return $this->delete(array("newsID" => $iNewsID));
        }
    }
