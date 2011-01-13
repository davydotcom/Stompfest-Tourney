<?php

require_once(APPPATH . "/models/sfmodel.php");

class User extends SFModel
    {
    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = "userID";
        }

    function Exists()
        {
        $this->db->where("Handle", $this->input->post("xHandle"));
        $this->db->where("Barcode", $this->input->post("xBarcode"));

        $xQuery = $this->db->get("users");

        if ( $xQuery->num_rows == 1 )
            {
            $result = $xQuery->row(0);

            return $result->userID;
            }

        return null;
        }

    function findByUserID($userID)
        {
        $this->db->where("userID", $userID);

        $xQuery = $this->db->get("users");
        if ( $xQuery->num_rows == 1 )
            return $xQuery->row();

        return null;
        }
    }
