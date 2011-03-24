<?php

require_once(APPPATH . "/models/sfmodel.php");

class Server extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'serverID';
        $this->required('name');
        $this->required('gameID');
        $this->required('hostName');
        $this->required('ipAddress');
        $this->required('port');
        $this->protectedAttribute('serverID');
        
        }

    }
