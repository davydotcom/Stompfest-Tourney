<?php
    $this->load->view("Includes/header");
?>

<div id="login_form">
	<h1>Login, Dude!</h1>

<?php
    echo(form_open("Login/Validate"));
	echo(form_input("username", "Username"));
	echo(form_password("password", "Password"));
	echo(form_submit("submit", "Login"));
	echo(form_close());
?>

</div>
