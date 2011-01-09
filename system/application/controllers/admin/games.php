<?php

require_once(APPPATH . "/controllers/admin/application.php");

class Games extends AdminApplicationController
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    }

    function index()
    {
        $this->load->model('game');
        $games = $this->game->find();
        $this->mysmarty->view('admin/games/index',array('games' => $games));
    }

    function show()
    {

    }


    function add()
    {

    }


    function create()
    {
    }

    function edit()
    {

    }

    function update()
    {

    }

    function destroy()
    {

    }

}
