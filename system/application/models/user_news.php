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
        return $this->find(array("userID" => $this->currentUser->userID));
        }

    function AddNews($iToUserID, $iMessage)
        {
        return $this->create(array("userID" => $iToUserID, "message" => $iMessage));
        }

    function DeleteItem($iNewsID)
        {
        return $this->delete(array("newsID" => $iNewsID));
        }
    }
