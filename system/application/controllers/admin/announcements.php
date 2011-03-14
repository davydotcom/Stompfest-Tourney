<?php

require_once(APPPATH . "/controllers/admin/application.php");

class Announcements extends AdminApplicationController
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    }

    function index()
    {
        $this->load->model('announcement');
        $this->load->model('user');

        $announcements = $this->announcement->find();
        $user_ids = array();
        foreach ($announcements as $announcement)
        {
            $user_ids[] = $announcement->userID;
        }
        if (!empty($user_ids))
        {
            $this->user->db->where_in('userID', $user_ids);
            $users = $this->user->find();

            foreach ($announcements as $announcement)
            {
                foreach ($users as $user)
                {
                    if ($user->userID == $announcement->userID)
                    {
                        $announcement->user = $user;
                    }
                }
            }
        }
        $this->mysmarty->view('admin/announcements/index', array('announcements' => $announcements));
    }

    function show($id)
    {
        $this->load_model_or_fail($id);
        $this->load->model('user');
        $this->currentAnnouncement->user = $this->user->findByID($this->currentAnnouncement->userID);

        $this->mysmarty->view('admin/announcements/show', array('announcement' => $this->currentAnnouncement));
    }

    function add()
    {
        $this->load->model('user');
        $this->mysmarty->view('admin/announcements/add');
    }

    function create()
    {
        $this->load->model('announcement');

        if ($this->announcement->create(array_merge($_POST, array('userID' => $this->currentUser->userID))))
        {
            $this->session->set_flashdata('notice', 'New announcement Record Created!');
            redirect("/admin/announcements");
        } else
        {
            $errors = implode('<br/>', $this->announcement->errors);
            $this->session->set_flashdata('error', 'Error saving announcement information!:<br/>' . $errors);
            redirect("/admin/announcements/add");

            //$this->add();
        }
    }

    function edit($id)
    {
        $this->load_model_or_fail($id);

        $this->mysmarty->view('admin/announcements/edit', array('announcement' => $this->currentAnnouncement));
    }

    function update($id)
    {
        $this->load_model_or_fail($id);
        $_POST['content'] = trim($_POST['content']);
        if ($this->announcement->update($this->currentAnnouncement->announcementID, $_POST))
        {
            $this->session->set_flashdata('notice', 'Announcement information successfully saved.');
            redirect("/admin/announcements");
        } else
        {
            $this->session->set_flashdata('error', 'Error saving announcement information!.');
            redirect("/admin/announcements/edit/" . $id);
        }
    }

    function destroy($id)
    {
        $this->load_model_or_fail($id);

        $this->announcement->delete(array('announcementID' => $this->currentAnnouncement->announcementID));
        $this->session->set_flashdata('notice', 'Announcement Removed!');
        redirect("/admin/announcements");
    }

    protected function load_model_or_fail($id=null)
    {
        if (empty($id))
        {
            $this->session->set_flashdata('error', 'announcement id Must be specified!');
            redirect("/admin/announcements");
            return false;
        }

        $this->load->model('announcement');
        $this->currentAnnouncement = $this->announcement->findByID($id);

        if (empty($this->currentAnnouncement))
        {
            $this->session->set_flashdata('error', 'Unable to find the requested Tournament');
            redirect("/admin/announcements");
            return false;
        }

        return true;
    }

}
