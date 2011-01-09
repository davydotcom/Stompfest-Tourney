<?php

class ApplicationController extends Controller
    {

    function __construct()
        {

        parent::Controller();

        //Filters That Run on Every Action
        $this->loadCurrentUser();
        }

    function requireUser()
        {
        if ( empty($this->currentUser) )
            {
            redirect("/login");

            return false;
            }

        return true;
        }

    function loadCurrentUser()
        {
        $this->load->model("User");

        $userID = $this->session->userdata('userID');
        $this->isLoggedIn = false;

        $this->mysmarty->assign('isLoggedIn', false);

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
