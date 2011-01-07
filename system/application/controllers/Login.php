<?php
require_once(APPPATH . "/controllers/application.php");
class Login extends Controller
    {
    function index()
        {
            $this->mysmarty->view('login/index');
        }

    function validate()
        {
            $this->load->model("Gamer");

            if ( $this->Gamer->Exists() )
            {
			$xData = array("Handle" => $this->input->post('xHandle'),
                           "IsLoggedIn" => true);

			$this->session->set_userdata($xData);
			redirect("/");
            }
            else
            {

			$this->index();
            }
        }
     function destroy()
     {

     }
    }