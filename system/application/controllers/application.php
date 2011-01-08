<?php

class ApplicationController extends Controller
    {

    function __construct()
        {

        parent::Controller();



        //Filters That Run on Every Action
        $this->loadCurrentUser();
        }

    function loadCurrentUser()
        {
        $this->load->model("User");
        $userID = $this->session->userdata('userID');
        $this->mysmarty->assign('isLoggedIn', false);
        $this->isLoggedIn = false;

        if ( !empty($userID) )
            {
            $this->currentUser = $this->User->findByUserID($userID);
            if ( !empty($this->currentUser))
                {
                    $this->mysmarty->assign('isLoggedIn', true);
                    $this->isLoggedIn = true;
                }
            }
        }

    }
