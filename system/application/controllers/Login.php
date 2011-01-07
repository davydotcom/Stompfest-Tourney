<?php

class Login extends Controller
    {
    function index()
        {
            $xPage = $this->load->view("Login",'',true);
            $this->mysmarty->view('main/index',array("xPage" => $xPage));
        }

    function validate()
        {
            $this->load->model("Gamer");

            if ( $this->Gamer->Exists() )
            {
			$xData = array("Handle" => $this->input->post('xHandle'),
                           "IsLoggedIn" => true);

			$this->session->set_userdata($xData);
			redirect("/main");
            }
            else
            {

			$this->index();
            }
        }
    }