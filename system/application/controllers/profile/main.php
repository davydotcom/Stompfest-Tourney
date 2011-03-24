<?php
require_once(APPPATH . "/controllers/application.php");

class Main extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();
        }

    function index()
        {
        $this->load->model("user_news");
        $this->currentUser->News = $this->user_news->GetMyNews();

        $this->mysmarty->assign("UserData", $this->currentUser);
        $this->mysmarty->view("/profile/index");
        }

    function view()
        {
        }

    function edit()
        {
        $this->mysmarty->assign("UserData", get_object_vars($this->currentUser));
        $this->mysmarty->view("/profile/edit");
        }

    function update()
        {
        $this->load->model("user");

        if ( $this->user->update($this->currentUser->userID, $_POST) )
            {
            $this->session->set_flashdata('notice', 'User information successfully saved.');
            redirect("/profile/main");
            }
        else
            {
            $this->session->set_flashdata('error', 'Error saving User information!.');
            $this->edit($id);
            }
        }

    /**
     * This is used for an AJAX call
     * 
     * @param int $iNewsID
     */
    function deleteNews($iNewsID)
        {
        $this->load->model("user_news");

        $this->user_news->DeleteItem($iNewsID);

        echo($iNewsID);
        }

    /***
     * AJAX call
     */
    function savePassword()
        {
        $this->load->model("user");

        $xPass = $this->input->post("xPass");

        if ( $this->currentUser->password != null )
            {
            $xCurr = $this->input->post("xCurr");

            if ( $xCurr != $this->currentUser->password )
                {
                echo("Invalid or missing password");
                return;
                }
            }

        $this->user->update($this->currentUser->userID, array("password" => $xPass));

        echo("GOOD");
        }

    }
