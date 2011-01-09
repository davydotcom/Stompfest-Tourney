<?php
require_once(APPPATH . "/models/sfmodel.php");

class Game extends SFModel
{

    function findGames($options = array())
    {
        $this->applyOptions($options);

        $query = $this->db->get($this->tableName);

        return $query->result();
    }



}
