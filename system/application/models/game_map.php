<?php

require_once(APPPATH . "/models/sfmodel.php");

class Game_map extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'gameMapID';
        $this->required('name');
        $this->required('gameID');
        $this->protectedAttribute('gameMapID');
        
        }

    }
