<?php

require_once(APPPATH . "/models/sfmodel.php");

class Comment extends SFModel
    {

    function __construct()
        {
        parent::__construct();

        $this->primaryKeyName = 'commentID';

        $this->required('attachmentType');
        $this->required('attachmentID');
        $this->required('userID');
        $this->required('content');
        $this->protectedAttribute('commentID');

        }

    }
