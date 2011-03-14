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
        $this->load->model('game_gamer_info');

        $gamer_infos = $this->game_gamer_info->where(array('gameID' => $this->currentGame->gameID))->find();
        $this->mysmarty->view('admin/games/show', array('game' => $this->currentGame,'gamer_infos' => $gamer_infos));
    }

    function add()
    {
        $this->mysmarty->view('admin/games/add');
    }

    function create()
    {
        $this->load->model('game');
        if ($this->game->create($_POST))
        {
            $this->session->set_flashdata('notice', 'New Game Record Created!');
            redirect("/admin/games");
        } else
        {
            $errors = implode('<br/>', $this->game->errors);
            $this->session->set_flashdata('error', 'Error saving game information!:<br/>' . $errors);
            redirect("/admin/games/add");

            //$this->add();
        }
    }
    function add_info($id)
    {
        $this->load_model_or_fail($id);
        $this->mysmarty->view('admin/games/info/add',array('game' => $this->currentGame));

    }

    function create_info($id)
    {
        $this->load_model_or_fail($id);

        $this->load->model('game_gamer_info');
        if ($this->game_gamer_info->create(array_merge($_POST,array('gameID' => $this->currentGame->gameID))))
        {
            $this->session->set_flashdata('notice', 'New User Game Info Field Record Created!');
            redirect("/admin/games/show/" . $this->currentGame->gameID);
        } else
        {
            $errors = implode('<br/>', $this->game_gamer_info->errors);
            $this->session->set_flashdata('error', 'Error saving User Game Info Field information!:<br/>' . $errors);
            redirect("/admin/games/add_info/" . $id);

            //$this->add();
        }
    }

    function delete_info($id)
    {
         $this->load_game_info_model_or_fail($id);
         $gameID = $this->currentGameGamerInfo->gameID;
         $this->game_gamer_info->delete(array('gameGamerInfoID' => $this->currentGameGamerInfo->gameGamerInfoID));
        $this->session->set_flashdata('notice', 'Game User Field Removed!');
        redirect("/admin/games/show/" . $gameID);
    }
    function edit_info($gameID,$id)
    {
        $this->load_model_or_fail($gameID);

        $this->load_game_info_model_or_fail($id);

        $this->mysmarty->view('admin/games/info/edit', array('game' => $this->currentGame,'game_gamer_info' => $this->currentGameGamerInfo));
    }
    function edit($id)
    {
        $this->load_model_or_fail($id);

        $this->mysmarty->view('admin/games/edit', array('game' => $this->currentGame));
    }

    function update($id)
    {
        $this->load_model_or_fail($id);
        $_POST['description'] = trim($_POST['description']);
        if ($this->game->update($this->currentGame->gameID, $_POST))
        {
            $this->session->set_flashdata('notice', 'Game information successfully saved.');
            redirect("/admin/games");
        } else
        {
            $this->session->set_flashdata('error', 'Error saving game information!.');
            $this->edit($id);
        }
    }
function update_info($id)
    {
        $this->load_game_info_model_or_fail($id);
        
        if ($this->game_gamer_info->update($this->currentGameGamerInfo->gameGamerInfoID, $_POST))
        {
            $this->session->set_flashdata('notice', 'Game user field information successfully saved.');
            redirect("/admin/games/show/" . $this->currentGameGamerInfo->gameID);
        } else
        {
            $errors = implode('<br/>', $this->game_gamer_info->errors);
            $errors = implode('<br/>', $_POST);
            $this->session->set_flashdata('error', 'Error saving User Game Info Field information!:<br/>' . $errors);
            $this->edit_info($this->currentGameGamerInfo->gameID,$id);
        }
    }
    function destroy($id)
    {
        $this->load_model_or_fail($id);

        $this->game->delete(array('gameID' => $this->currentGame->gameID));
        $this->session->set_flashdata('notice', 'Game Removed!');
        redirect("/admin/games");
    }

    protected function load_model_or_fail($id=null)
    {
        if (empty($id))
        {
            $this->session->set_flashdata('error', 'Game ID Must be specified!');
            redirect("/admin/games");
            return false;
        }

        $this->load->model('game');
        $this->currentGame = $this->game->findByID($id);

        if (empty($this->currentGame))
        {
            $this->session->set_flashdata('error', 'Unable to find the requested Game');
            redirect("/admin/games");
            return false;
        }

        return true;
    }

    protected function load_game_info_model_or_fail($id=null)
    {
        if (empty($id))
        {
            $this->session->set_flashdata('error', 'Game Info ID Must be specified!');
            redirect("/admin/games");
            return false;
        }

        $this->load->model('game_gamer_info');
        $this->currentGameGamerInfo = $this->game_gamer_info->findByID($id);

        if (empty($this->currentGameGamerInfo))
        {
            $this->session->set_flashdata('error', 'Unable to find the requested Game Gamer Info');
            redirect("/admin/games");
            return false;
        }

        return true;
    }

}
