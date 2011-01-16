<?php

require_once(APPPATH . "/models/sfmodel.php");

class tourney_gamer extends SFModel
    {
    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = "TTID";
       }
    }
