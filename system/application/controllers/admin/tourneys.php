<?php

require_once(APPPATH . "/controllers/admin/application.php");

class Tourneys extends AdminApplicationController
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    }

    function index()
    {
        $this->load->model('tourney');
        $this->load->model('game');
        $tourneys = $this->tourney->find();
        $game_ids = array();
        foreach($tourneys as $tourney)
        {
            $game_ids[] = $tourney->gameID;
        }
        $this->game->db->where_in('gameID',$game_ids);
        $games = $this->game->find();

        foreach($tourneys as $tourney)
        {
            foreach($games as $game)
            {
                if($game->gameID == $tourney->gameID)
                {
                    $tourney->game = $game;
                }
            }
        }
        $this->mysmarty->view('admin/tourneys/index', array('tourneys' => $tourneys));
    }

    function show($id)
    {
        $this->load_model_or_fail($id);
        $this->load->model('game');
        $this->currentTourney->game = $this->game->findByID($this->currentTourney->gameID);

        $this->mysmarty->view('admin/tourneys/show', array('tourney' => $this->currentTourney));
    }

    function add()
    {
        $this->load->model('game');
        $games = $this->game->where(array('active' => '1'))->find();
        $this->mysmarty->view('admin/tourneys/add',array('games' => $games));
    }

    function create()
    {
        $this->load->model('tourney');
        
        if ($this->tourney->create($_POST))
        {
            $this->session->set_flashdata('notice', 'New Tourney Record Created!');
            redirect("/admin/tourneys");
        } else
        {
            $errors = implode('<br/>', $this->tourney->errors);
            $this->session->set_flashdata('error', 'Error saving tourney information!:<br/>' . $errors);
            redirect("/admin/tourneys/add");

            //$this->add();
        }
    }
    
    function edit($id)
    {
        $this->load_model_or_fail($id);
                $this->load->model('game');

        $games = $this->game->where(array('active' => '1'))->find();

        $this->mysmarty->view('admin/tourneys/edit', array('tourney' => $this->currentTourney,'games' => $games));
    }

    function update($id)
    {
        $this->load_model_or_fail($id);
        $_POST['description'] = trim($_POST['description']);
        $_POST['matchInstructions'] = trim($_POST['matchInstructions']);
        if ($this->tourney->update($this->currentTourney->tourneyID, $_POST))
        {
            $this->session->set_flashdata('notice', 'Tournament information successfully saved.');
            redirect("/admin/tourneys");
        } else
        {
            $this->session->set_flashdata('error', 'Error saving tournament information!.');
            redirect("/admin/tourneys/edit/" . $id );

        }
    }

    function destroy($id)
    {
        $this->load_model_or_fail($id);

        $this->tourney->delete(array('tourneyID' => $this->currentTourney->tourneyID));
        $this->session->set_flashdata('notice', 'Tournament Removed!');
        redirect("/admin/tourneys");
    }

    protected function load_model_or_fail($id=null)
    {
        if (empty($id))
        {
            $this->session->set_flashdata('error', 'Tourney ID Must be specified!');
            redirect("/admin/tourneys");
            return false;
        }

        $this->load->model('tourney');
        $this->currentTourney = $this->tourney->findByID($id);

        if (empty($this->currentTourney))
        {
            $this->session->set_flashdata('error', 'Unable to find the requested Tournament');
            redirect("/admin/tourneys");
            return false;
        }

        return true;
    }

    

}
