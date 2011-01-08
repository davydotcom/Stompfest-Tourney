<?php

class User extends Model
    {

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
            {
            return $xQuery->row(0);
            }
        return null;
        }

    function update($options = array())
        {
        $this->db->where("userID", $this->userID);
        $this->db->update($options);
        }

    }
