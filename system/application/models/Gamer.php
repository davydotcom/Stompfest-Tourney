<?php

class Gamer extends Model
    {
    function validate()
        {
        $this->db->where("Handle", $this->input->post("xHandle"));
		$this->db->where("Barcode", $this->input->post("xBarcode"));

        $xQuery = $this->db->get("gamers");

		if ( $xQuery->num_rows == 1 )
			return true;

        return false;
        }
    }
