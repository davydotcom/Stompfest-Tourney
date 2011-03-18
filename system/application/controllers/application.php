<?php

class ApplicationController extends Controller
    {
    function __construct()
        {
        parent::Controller();

        date_default_timezone_set("America/Indiana/Indianapolis");

        $xA_CurrPage = split("/", $_SERVER["REQUEST_URI"]);

        $this->session->eventID = 1;                    //  TODO: Get the current event
        $this->controllerName = get_class($this);

        $this->mysmarty->assign("CurrPage", $xA_CurrPage[1]);
        $this->mysmarty->assign('controllerName', $this->controllerName);

        $this->loadFlashMessages();
        $this->loadCurrentUser();
        }

    function requireUser()
        {
        if ( empty($this->currentUser) )
            {
            redirect("/login/main");

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

            if ( !empty($this->currentUser) )
                {
                $this->mysmarty->assign('isLoggedIn', true);
                $this->isLoggedIn = true;
                }
            }
        }

    protected function loadFlashMessages()
        {
        $notice = $this->session->flashdata('notice');
        $warning = $this->session->flashdata('warning');
        $error = $this->session->flashdata('error');

        if ( !empty($notice) )
            $this->mysmarty->assign('flashNotice', $notice);

        if ( !empty($warning) )
            $this->mysmarty->assign('flashWarning', $warning);

        if ( !empty($error) )
            $this->mysmarty->assign('flashError', $error);
        }

    }
