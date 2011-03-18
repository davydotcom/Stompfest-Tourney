<?php

require_once(APPPATH . "/controllers/application.php");

class Main extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();
        }

    function index()
        {
        $this->mysmarty->view("/login/index");
        }

    function validate()
        {
        $this->load->model("User");

        $userID = $this->User->Exists($this->input->post("xCurrHandle"), $this->input->post("xPass"));

        if ( empty($userID) )
            {
            $this->session->set_flashdata('error', 'Invalid username / barcode combination!');
            redirect("/login/main");
            }
        else
            {
            $xData = array("userID" => $userID, "IsLoggedIn" => true);

            $this->session->set_userdata($xData);
            $this->session->set_flashdata('notice', 'Login Successful!');
            redirect("/");
            }
        }

    function create()
        {
        $this->load->model("User");

        $xHandle = $this->input->post("xNewHandle");
        //$this->input->post("xPass")

//        if ( $this->User->CanFind(array("handle" => $xHandle, "password" => null)) )

        }

    function destroy()
        {
//        $this->session->sess_destroy();
        $this->session->unset_userdata('IsLoggedIn');
        $this->session->unset_userdata('userID');
        $this->session->set_flashdata('warning', 'You have been logged out!');
        redirect("/");
        }

    }
