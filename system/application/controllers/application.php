<?php

class ApplicationController extends Controller
    {

    function __construct()
        {

        parent::Controller();



        //Filters That Run on Every Action
        $this->loadCurrentGamer();
        }

    function loadCurrentGamer()
        {
        $this->load->model("User");
        $userID = $this->session->userdata('userID');
        $this->mysmarty->assign('isLoggedIn', false);
        if ( $handle != null )
            {
            $this->currentUser = $this->User->findByUserID($userID);
            if ( $this->currentUser != null )
                {
                $this->mysmarty->assign('isLoggedIn', true);
                }
            }
        }

    }
