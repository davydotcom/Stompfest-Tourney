<?php

class Login extends Controller
    {
    function index()
        {
        $this->load->views("Main", array("xPage" => "Login"));
        }

    function Validate()
        {
		$this->load->model("Gamer");

		if ( $this->Gamer->Exists() )
            {
			$xData = array("Handle" => $this->input->post('xHandle'),
                           "IsLoggedIn" => true);

			$this->session->set_userdata($xData);
			redirect("Main");
            }
		else
            {
			$this->index();
            }
        }
    }