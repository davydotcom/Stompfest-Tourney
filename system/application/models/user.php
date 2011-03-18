<?php

require_once(APPPATH . "/models/sfmodel.php");

class User extends SFModel
    {
    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = "userID";
        $this->required('handle');
        $this->required('barcode');
        }

    function Exists($iHandle, $iBarcode)
        {
        $xDude = $this->first(array("Handle" => $iHandle, "Barcode" => $iBarcode));
        if ( $xDude == null )
            return null;

        return $xDude->userID;
        }

    function findByUserID($iUserID)
        {
        $xDude = $this->first(array("userID" => $iUserID));
        if ( $xDude == null )
            return null;

        $this->db->where("captainID", $iUserID);
        $this->db->from("tourney_teams");

        $xDude->IAmCaptain = ($this->db->count_all_results() != 0);

        return $xDude;
        }

    }
