<?php
require_once(APPPATH . "/controllers/application.php");

class Main extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->load->library('session');
        }

    function index()
        {
            $this->load->model('announcement');
            $this->load->model('user');
            $announcements = $this->announcement->where(array('active' => 1))->find(array('order' => array('createdAt','DESC')));
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
        $this->mysmarty->view('/main/index',array('announcements' => $announcements));
        }
    }
