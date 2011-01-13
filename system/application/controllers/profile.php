<?php
require_once(APPPATH . "/controllers/application.php");

class Profile extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();
        }

    function index()
        {
        $this->mysmarty->assign("UserData", get_object_vars($this->currentUser));
        $this->mysmarty->view('profile/index');
        }

    function view()
        {
        }

    function edit()
        {
        $this->mysmarty->assign("UserData", get_object_vars($this->currentUser));
        $this->mysmarty->view("profile/edit");
        }

    function update()
        {
        $this->load->model("user");

        if ( $this->user->update($this->currentUser->userID, $_POST) )
            {
            $this->session->set_flashdata('notice', 'User information successfully saved.');
            redirect("/profile");
            }
        else
            {
            $this->session->set_flashdata('error', 'Error saving User information!.');
            $this->edit($id);
            }
        }
    }
