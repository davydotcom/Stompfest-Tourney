<div id="login_form">
	<h1>Login, Dude!</h1>

<?php
    $this->load->helper("form");

    echo(form_open("login/validate"));
	echo(form_input(array("name" => "xHandle", "maxlength" => 30, "size" => 30)));
	echo(form_input(array("name" => "xBarcode", "maxlength" => 10)));
	echo(form_submit("submit", "Login"));
	echo(form_close());
?>

</div>
