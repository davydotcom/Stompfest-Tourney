<?php
require_once(APPPATH . "/controllers/application.php");

class Profile extends ApplicationController
    {
    function  __construct()
        {
   		parent::__construct();

        $this->requireUser();
        }

    function index()
        {
        $this->mysmarty->assign("UserData", get_object_vars($this->currentUser));
        $this->mysmarty->view('profile/index');
        }

    function view()
        {
        }

    function edit()
        {
        $this->mysmarty->assign("UserData", get_object_vars($this->currentUser));
        $this->mysmarty->view("profile/edit");
        }

    function update()
        {
 echo("---> " . $this->UserID . " - " . var_dump($this->currentUser));

      $this->currentUser->update($_POST);

 //       redirect("/profile/index");
        }
    }
