<?php
    $this->load->view("Includes/Header");

    if ( empty($xPage) )
        $xPage = "Home";

    $this->load->view($xPage);
    $this->load->view("Includes/Footer");
