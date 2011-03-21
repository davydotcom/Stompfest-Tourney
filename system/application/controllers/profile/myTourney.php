<?php

require_once(APPPATH . "/controllers/application.php");

class MyTourney extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();

        require_once(APPPATH . "/controllers/tourney/helpers.php");
        }

    function index()
        {
        redirect("/tourney/main/index/true");
        }

    /**
     * This is used in an AJAX call
     *
     * @param <int> $iTTID tourney_gamers.TTID
     */
    function RemoveMe($iTTID)
        {
        $this->load->model("user_news");
        $this->load->model("tourney_gamer");

        $xTG = $this->tourney_gamer->first(array("TTID" => $iTTID));
        if ( !empty($xTG) )
            {
            if ( $xTG->teamID == 0 )
                $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: No longer looking for a Team.", $xTG->tourneyID);
            else
                $this->user_news->AddNews($this->currentUser->userID, "!TOUR!: Drop out Team <b>!TEAM!</b>.", $xTG->tourneyID, $xTG->teamID);
            }

        $this->tourney_gamer->delete(array("TTID" => $iTTID));

        echo("GOOD");
        }

    function dropOut($iTourneyID)
        {
        $this->load->model("tourney_gamer");

        $this->tourney_gamer->delete(array("tourneyID" => $iTourneyID, "userID" => $this->currentUser->userID));
        }

    /**
     * This is used in an AJAX call
     */
    function SaveLooking()
        {
        $this->load->model("tourney_gamer");

        if ( $this->tourney_gamer->update($_POST["TTID"], array("comments" => $_POST["Comment"])) )
            echo("GOOD");
        else
            echo("Failed to update Gamer record");
        }
    }
