<?php

require_once(APPPATH . "/controllers/application.php");

class AdminApplicationController extends ApplicationController
{

    function __construct()
    {
        parent::__construct();

        $this->requireAdministrator();
    }

    function requireAdministrator()
    {
        if (empty($this->currentUser))
        {
            $this->session->set_flashdata('error', 'You must be logged in to view this section!');
            redirect("/login");
            return false;
        }
        if(!$this->currentUser->is_super_admin)
        {
            $this->session->set_flashdata('error', 'You must be an administrator to view this section!');
            redirect("/");
            return false;
        }
        return true;
    }

}
