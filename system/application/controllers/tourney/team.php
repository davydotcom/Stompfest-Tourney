<?php

require_once(APPPATH . "/controllers/application.php");

class Team extends ApplicationController
    {
    function Add($iTourneyID)
        {
        $this->load->model("tourney");

        $xTourney = $this->tourney->findByID($iTourneyID);

        $this->mysmarty->view("/tourney/team/add", array("Tourney" => $xTourney));
        }

    function saveNew()
        {
        $this->load->model("tourney_team");
        $this->load->model("tourney_gamer");

        $xA_Team = $_POST;
        $xA_Team["captainID"] = $this->currentUser->UserID;

        if ( $this->tourney_team->create($xA_Team) )
            {
            $this->session->set_flashdata('notice', 'Team successfully created and registered for the Tournament.');
            redirect("/profile");
            }
        else
            {
            $this->session->set_flashdata('error', 'Error saving Team information!.');
            $this->edit($id);
            }
        }
    }
