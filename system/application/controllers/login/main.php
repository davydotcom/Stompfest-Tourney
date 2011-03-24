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

    /***
     * AJAX call
     */
    function validate()
        {
        $this->load->model("user");

        $xPass = $this->input->post("xPass");
        $xHandle = $this->input->post("xHandle");

        $xDude = $this->user->first(array("handle" => $xHandle, "password" => $xPass));
        if ( empty($xDude) )
            {
            echo("Invalid Username/Password combination!");
            return;
            }

        $this->session->set_userdata(array("userID" => $xDude->userID, "IsLoggedIn" => true));

        echo("GOOD");
        }

    /***
     * AJAX call
     */
    function create()
        {
        $this->load->model("user");

        $xBar = $this->input->post("xBar");
        $xHandle = $this->input->post("xHandle");

        $xDude = $this->user->first(array("handle" => $xHandle, "barcode" => $xBar));
        if ( $xDude == null )
            {
            echo("Invalid username / barcode combination! --- $xBar -- $xHandle");
            return;
            }

        if ( !empty($xDude->password) )
            {
            echo("User already exists.");
            return;
            }

        echo("GOOD");
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
