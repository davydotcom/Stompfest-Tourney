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
        $this->mysmarty->view('admin/games/index', array('games' => $games));
        }

    function show($id)
        {
        $this->load_model_or_fail($id);
        $this->mysmarty->view('admin/games/show', array('game' => $this->currentGame));
        }

    function add()
        {
        $this->mysmarty->view('admin/games/add');
        }

    function create()
        {
        $this->load->model('game');
        if ( $this->game->create($_POST) )
            {
            $this->session->set_flashdata('notice', 'New Game Record Created!');
            redirect("/admin/games");
            }
        else
            {
            $this->session->set_flashdata('error', 'Error saving game information!.');
            $this->add();
            }
        }

    function edit($id)
        {
        $this->load_model_or_fail($id);

        $this->mysmarty->view('admin/games/edit', array('game' => $this->currentGame));
        }

    function update($id)
        {
        $this->load_model_or_fail($id);
        if ( $this->game->update($this->currentGame->gameID, $_POST) )
            {
            $this->session->set_flashdata('notice', 'Game information successfully saved.');
            redirect("/admin/games");
            }
        else
            {
            $this->session->set_flashdata('error', 'Error saving game information!.');
            $this->edit($id);
            }
        }

    function destroy($id)
        {
        $this->load_model_or_fail($id);

        $this->game->destroy(array('conditions' => array('gameID' => $this->currentGame->gameID)));
        $this->session->set_flashdata('notice', 'Game Removed!');
        redirect("/admin/games");
        }

    protected function load_model_or_fail($id=null)
        {
        if ( empty($id) )
            {
            $this->session->set_flashdata('error', 'Game ID Must be specified!');
            redirect("/admin/games");
            return false;
            }

        $this->load->model('game');
        $this->currentGame = $this->game->findByID($id);

        if ( empty($this->currentGame) )
            {
            $this->session->set_flashdata('error', 'Unable to find the requested Game');
            redirect("/admin/games");
            return false;
            }

        return true;
        }

    }
