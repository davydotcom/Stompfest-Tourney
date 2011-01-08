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
        $this->load->model("Gamer");
        $handle = $this->session->userdata('Handle');
        $this->mysmarty->assign('isLoggedIn', false);
        if ( $handle != null )
            {
            $this->currentGamer = $this->Gamer->findByHandle($handle);
            if ( $this->currentGamer != null )
                {
                $this->mysmarty->assign('isLoggedIn', true);
                }
            }
        }

    }
