<?php

require_once(APPPATH . "/models/sfmodel.php");

class Announcement extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'announcementID';

        $this->required('subject');
        $this->required('content');
        $this->required('userID');
        $this->protectedAttribute('announcementID');

        }

    }
