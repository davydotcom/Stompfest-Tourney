<?php
require_once(APPPATH . "/controllers/application.php");

class Login extends ApplicationController
    {
    function index()
        {
            $this->mysmarty->view('login/index');
        }

    function validate()
        {
            $this->load->model("User");
            $userID = $this->User->Exists();
            if ( !empty($userID) )
            {
			$xData = array("userID" => $userID,
                           "IsLoggedIn" => true);

			$this->session->set_userdata($xData);
                        $this->session->set_flashdata('notice','Login Successful!');
			redirect("/");
            }
            else
            {
                        $this->session->set_flashdata('error','Invalid username / barcode combination!');
                        redirect("/login");
//			$this->index();
            }
        }

     function destroy()
         {
         $this->session->sess_destroy();

         redirect("/");
         }
    }