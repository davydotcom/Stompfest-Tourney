<!DOCTYPE html>
<html>
	<head>
		<title>{block name=title}Stompfest Tournament Manager{/block}</title>

		<link href="/stylesheets/960.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="/stylesheets/application.css" media="screen" rel="stylesheet" type="text/css" />
	</head>

	<body>

		<div id="header">
			<ul id="user_navigation">
				<li><a href="#">Login</a></li>
				<li><a href="#">Register</a></li>
			</ul>
			<h1>Stompfest <span class="smaller_header">Tournament Manager</span></h1>

		</div>

		<div id="content_wrapper" class="container_12">
			<div id="left_navigation_wrapper" class="grid_2">
				<ul id="left_navigation">
					<li><a href="#" class="active">Overview</a></li>
					<li><a href="#">Tournaments</a></li>
					<li><a href="#">Support</a></li>
				</ul>
			</div>
			<div id="main_content_wrapper" class="grid_10">
				<div id="main_content">
					<div id="main_content_left">
					
						{block name=main_content}Main Content Goes Here!{/block}
					</div>
					<div id="main_content_right">
						{block name=main_content_right}Right Bar Content Here!{/block}

					</div>
				</div>
			</div>
		</div>
	</body>

</html>