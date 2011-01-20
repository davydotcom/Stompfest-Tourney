<?php

require_once(APPPATH . "/models/sfmodel.php");

class Server extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'serverID';
        }

    }
