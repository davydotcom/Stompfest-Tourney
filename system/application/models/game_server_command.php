<?php

require_once(APPPATH . "/models/sfmodel.php");

class Game_server_command extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'gameServerCommandID';
        $this->required('command');
        $this->required('gameID');
        $this->protectedAttribute('gameServerCommandID');
        
        }

    }
