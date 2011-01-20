<?php

require_once(APPPATH . "/controllers/admin/application.php");

class Servers extends AdminApplicationController
    {

    function __construct()
        {
        parent::__construct();

        $this->load->library('session');
        }

    function index()
        {
        $this->load->model('server');
        $servers = $this->server->find();
        $this->mysmarty->view('admin/servers/index', array('servers' => $servers));
        }

    function show($id)
        {
        $this->load_model_or_fail($id);
        $this->mysmarty->view('admin/servers/show', array('servers' => $this->currentServer));
        }

    function add()
        {
        $this->mysmarty->view('admin/servers/add');
        }

    function create()
        {
        $this->load->model('server');
        if ( $this->game->create($_POST) )
            {
            $this->session->set_flashdata('notice', 'New Server Record Created!');
            redirect("/admin/servers");
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

        $this->mysmarty->view('admin/servers/edit', array('server' => $this->currentServer));
        }

    function update($id)
        {
        $this->load_model_or_fail($id);
        
        if ( $this->server->update($this->currentServer->serverID, $_POST) )
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

        $this->server->destroy(array('conditions' => array('serverID' => $this->currentServer->serverID)));
        $this->session->set_flashdata('notice', 'Game Removed!');
        redirect("/admin/servers");
        }

    protected function load_model_or_fail($id=null)
        {
        if ( empty($id) )
            {
            $this->session->set_flashdata('error', 'Server ID Must be specified!');
            redirect("/admin/servers");
            return false;
            }

        $this->load->model('server');
        $this->currentServer = $this->server->findByID($id);

        if ( empty($this->currentServer) )
            {
            $this->session->set_flashdata('error', 'Unable to find the requested Server');
            redirect("/admin/servers");
            return false;
            }

        return true;
        }

    }
