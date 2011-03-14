<?php

require_once(APPPATH . "/models/sfmodel.php");

class Game_gamer_info extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'gameGamerInfoID';
        $this->required('gameID');
        $this->required('name');

        }

    }
