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

    function show($id)
    {
        $this->load_model_or_fail($id);
        $this->mysmarty->view('admin/games/show',array('game' => $this->currentGame));
    }


    function add()
    {

    }


    function create()
    {
    }

    function edit($id)
    {
        $this->load_model_or_fail($id);
    }

    function update($id)
    {
        $this->load_model_or_fail($id);

    }

    function destroy($id)
    {
        $this->load_model_or_fail($id);

    }


    protected function load_model_or_fail($id=null)
    {
        
        if(empty($id))
        {
            $this->session->set_flashdata('error','Game ID Must be specified!');
            redirect("/admin/games");
            return false;
        }

        $this->load->model('game');
        $this->currentGame = $this->game->findByID($id);

        if(empty($this->currentGame))
        {
            $this->session->set_flashdata('error','Unable to find the requested Game');
            redirect("/admin/games");
            return false;
        }
        return true;
    }
}
