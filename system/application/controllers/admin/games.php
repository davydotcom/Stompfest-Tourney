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
        $this->load->model('game_map');
        $this->load->model('game_server_command');
        $gamer_infos = $this->game_gamer_info->where(array('gameID' => $this->currentGame->gameID))->find();
        
        $game_maps = $this->game_map->where(array('gameID' => $this->currentGame->gameID))->find(); 


        $game_commands = $this->game_server_command->where(array('gameID' => $this->currentGame->gameID))->find(); 

        $this->mysmarty->view('admin/games/show', array('game' => $this->currentGame,'gamer_infos' => $gamer_infos,'game_maps' => $game_maps,'game_server_commands' => $game_commands));
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

    function add_map($id)
    {
        $this->load_model_or_fail($id);
        $this->mysmarty->view('admin/games/maps/add',array('game' => $this->currentGame));

    }
    function add_command($id)
    {
        $this->load_model_or_fail($id);
        $this->mysmarty->view('admin/games/commands/add',array('game' => $this->currentGame));

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
    function create_map($id)
    {
        $this->load_model_or_fail($id);

        $this->load->model('game_map');
        if ($this->game_map->create(array_merge($_POST,array('gameID' => $this->currentGame->gameID))))
        {
            $this->session->set_flashdata('notice', 'New Map Record Created!');
            redirect("/admin/games/show/" . $this->currentGame->gameID);
        } else
        {
            $errors = implode('<br/>', $this->game_map->errors);
            $this->session->set_flashdata('error', 'Error saving Map information!:<br/>' . $errors);
            redirect("/admin/games/add_map/" . $id);

        }
    }

function create_command($id)
    {
        $this->load_model_or_fail($id);

        $this->load->model('game_server_command');
        if ($this->game_server_command->create(array_merge($_POST,array('gameID' => $this->currentGame->gameID))))
        {
            $this->session->set_flashdata('notice', 'New Server Command Created!');
            redirect("/admin/games/show/" . $this->currentGame->gameID);
        } else
        {
            $errors = implode('<br/>', $this->game_server_cmmand->errors);
            $this->session->set_flashdata('error', 'Error saving Server Command information!:<br/>' . $errors);
            redirect("/admin/games/add_command/" . $id);

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
    function delete_command($id)
    {
         $this->load_game_command_model_or_fail($id);
         $gameID = $this->currentGameServerCommand->gameID;
         $this->game_server_command->delete(array('gameServerCommandID' => $this->currentGameServerCommand->gameServerCommandID));
        $this->session->set_flashdata('notice', 'Game Server Command Removed!');
        redirect("/admin/games/show/" . $gameID);
    }
    function delete_map($id)
    {
         $this->load_game_map_model_or_fail($id);
         $gameID = $this->currentGameMap->gameID;
         $this->game_map->delete(array('gameMapID' => $this->currentGameMap->gameMapID));
        $this->session->set_flashdata('notice', 'Game Map Removed!');
        redirect("/admin/games/show/" . $gameID);
    }
    function edit_info($gameID,$id)
    {
        $this->load_model_or_fail($gameID);

        $this->load_game_info_model_or_fail($id);

        $this->mysmarty->view('admin/games/info/edit', array('game' => $this->currentGame,'game_gamer_info' => $this->currentGameGamerInfo));
    }
    function edit_map($gameID,$id)
    {
        $this->load_model_or_fail($gameID);

        $this->load_game_map_model_or_fail($id);

        $this->mysmarty->view('admin/games/maps/edit', array('game' => $this->currentGame,'game_map' => $this->currentGameMap));
    }
    function edit_command($gameID,$id)
    {
        $this->load_model_or_fail($gameID);

        $this->load_game_command_model_or_fail($id);

        $this->mysmarty->view('admin/games/commands/edit', array('game' => $this->currentGame,'game_server_command' => $this->currentGameServerCommand));
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
    function update_map($id)
    {
        $this->load_game_map_model_or_fail($id);
        
        if ($this->game_map->update($this->currentGameMap->gameMapID, $_POST))
        {
            $this->session->set_flashdata('notice', 'Game map field information successfully saved.');
            redirect("/admin/games/show/" . $this->currentGameMap->gameID);
        } else
        {
            $errors = implode('<br/>', $this->game_map->errors);
            $errors = implode('<br/>', $_POST);
            $this->session->set_flashdata('error', 'Error saving User Game Map Field information!:<br/>' . $errors);
            $this->edit_map($this->currentGameMap->gameID,$id);
        }
    }
    function update_command($id)
    {
        $this->load_game_command_model_or_fail($id);
        $_POST['description'] = trim($_POST['description']);

        if ($this->game_server_command->update($this->currentGameServerCommand->gameServerCommandID, $_POST))
        {
            $this->session->set_flashdata('notice', 'Game server command information successfully saved.');
            redirect("/admin/games/show/" . $this->currentGameServerCommand->gameID);
        } else
        {
            $errors = implode('<br/>', $this->game_server_command->errors);
            $errors = implode('<br/>', $_POST);
            $this->session->set_flashdata('error', 'Error saving Game Server Command information!:<br/>' . $errors);
            $this->edit_command($this->currentGameServerCommand->gameID,$id);
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
protected function load_game_map_model_or_fail($id=null)
    {
        if (empty($id))
        {
            $this->session->set_flashdata('error', 'Game Map ID Must be specified!');
            redirect("/admin/games");
            return false;
        }

        $this->load->model('game_map');
        $this->currentGameMap = $this->game_map->findByID($id);

        if (empty($this->currentGameMap))
        {
            $this->session->set_flashdata('error', 'Unable to find the requested Game Map');
            redirect("/admin/games");
            return false;
        }

        return true;
    }
    protected function load_game_command_model_or_fail($id=null)
    {
        if (empty($id))
        {
            $this->session->set_flashdata('error', 'Game Command ID Must be specified!');
            redirect("/admin/games");
            return false;
        }

        $this->load->model('game_server_command');
        $this->currentGameServerCommand = $this->game_server_command->findByID($id);

        if (empty($this->currentGameServerCommand))
        {
            $this->session->set_flashdata('error', 'Unable to find the requested Game Server Command');
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
