<?php

require_once(APPPATH . "/models/sfmodel.php");

class Game extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'gameID';

        $this->required('name');
        $this->required('genre');
        $this->required('short_name');
        $this->protectedAttribute('gameID');
        
        }

    }
