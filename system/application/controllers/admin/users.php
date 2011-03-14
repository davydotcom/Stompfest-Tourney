<?php

require_once(APPPATH . "/controllers/admin/application.php");

class Users extends AdminApplicationController
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    }

    function index()
    {
        $this->load->model('user');
        

        $users = $this->user->find();
        
        $this->mysmarty->view('admin/users/index', array('users' => $users));
    }

    function show($id)
    {
        $this->load_model_or_fail($id);
        $this->mysmarty->view('admin/users/show', array('user' => $this->currentUserObject));
    }

    function add()
    {
        $this->load->model('user');
        $this->mysmarty->view('admin/users/add');
    }

    function create()
    {
        $this->load->model('user');

        if ($this->user->create($_POST))
        {
            $this->session->set_flashdata('notice', 'New user Record Created!');
            redirect("/admin/users");
        } else
        {
            $errors = implode('<br/>', $this->user->errors);
            $this->session->set_flashdata('error', 'Error saving user information!:<br/>' . $errors);
            redirect("/admin/users/add");

            //$this->add();
        }
    }

    function edit($id)
    {
        $this->load_model_or_fail($id);

        $this->mysmarty->view('admin/users/edit', array('user' => $this->currentUserObject));
    }

    function update($id)
    {
        $this->load_model_or_fail($id);
        
        if ($this->user->update($this->currentUserObject->userID, $_POST))
        {
            $this->session->set_flashdata('notice', 'User information successfully saved.');
            redirect("/admin/users");
        } else
        {
            $this->session->set_flashdata('error', 'Error saving user information!.');
            redirect("/admin/users/edit/" . $id);
        }
    }

    function destroy($id)
    {
        $this->load_model_or_fail($id);

        $this->user->delete(array('userID' => $this->currentUserObject->userID));
        $this->session->set_flashdata('notice', 'User Removed!');
        redirect("/admin/users");
    }

    protected function load_model_or_fail($id=null)
    {
        if (empty($id))
        {
            $this->session->set_flashdata('error', 'user id Must be specified!');
            redirect("/admin/users");
            return false;
        }

        $this->load->model('user');
        $this->currentUserObject = $this->user->findByID($id);

        if (empty($this->currentUserObject))
        {
            $this->session->set_flashdata('error', 'Unable to find the requested User');
            redirect("/admin/users");
            return false;
        }

        return true;
    }

}
