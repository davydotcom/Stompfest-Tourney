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
        $this->load->model("tourney");

        $xTourn = $this->tourney->find();

        $this->mysmarty->view("tourney/main/index", array("Tourneys" => $xTourn));
        }
    }