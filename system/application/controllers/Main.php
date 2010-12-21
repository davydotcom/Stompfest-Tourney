<?php

class Login extends Controller
    {
    function index()
        {
        $this->load->view("Main", array("xPage" => "Login"));
        }

    function Validate()
        {
		$this->load->model("membership_model");

		$xQuery = $this->membership_model->validate();

		if($query) // if the user's credentials validated...
		{
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('site/members_area');
		}
		else // incorrect username or password
		{
			$this->index();
		}
        }
    }
