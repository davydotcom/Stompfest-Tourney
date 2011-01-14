<?php

require_once(APPPATH . "/models/sfmodel.php");

class Tourney extends SFModel
    {
    function __construct()
        {
        parent::__construct();
 
        $this->primaryKeyName = 'tourneyID';
       }
    }
