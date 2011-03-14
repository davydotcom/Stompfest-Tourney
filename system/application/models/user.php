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

    function findByUserID($iUserID)
        {
        $this->db->where("userID", $iUserID);

        $xQuery = $this->db->get("users");
        if ( $xQuery->num_rows == 1 )
            {
            $xUser = $xQuery->row();

            $this->db->where("captainID", $iUserID);
            $this->db->from("tourney_teams");

            $xUser->IAmCaptain = ($this->db->count_all_results() != 0);

            return $xUser;
            }

        return null;
        }

    }
