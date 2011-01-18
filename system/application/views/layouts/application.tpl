<!DOCTYPE html>
<html>
	<head>
		<title>{block name=title}Stompfest Tournament Manager{/block}</title>

		<link href="/stylesheets/960.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="/stylesheets/application.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="/stylesheets/temp.css" media="screen" rel="stylesheet" type="text/css" />
        <script LANGUAGE="JavaScript" SRC="/javascripts/JQuery.js"></script>
        <script LANGUAGE="JavaScript" SRC="/javascripts/SF.js"></script>
        <script LANGUAGE="JavaScript" SRC="/javascripts/MaskedInput.js"></script>
	</head>

	<body>
		<div id="header">
			<ul id="user_navigation">
                {if $isLoggedIn == true}
                    <li><a href="/login/destroy">Logout</a></li>
                {else}
                    <li><a href="/login">Login</a></li>
                {/if}
			</ul>
			<h1>Stompfest <span class="smaller_header">Tournament Manager</span></h1>
		</div>

                {if isset($flashNotice)}
                    <div id="xFlashNotice" class="flash notice">
                        <p>{$flashNotice}</p>
                    </div>

                    <script>FadeItOut("xFlashNotice");</script>
                {/if}
                {if isset($flashWarning)}
                    <div class="flash warning">
                        <p>{$flashWarning}</p>
                    </div>
                {/if}
                {if isset($flashError)}
                    <div class="flash error">
                        <p>{$flashError}</p>
                    </div>
                {/if}
		<div id="content_wrapper" class="container_12">
			<div id="left_navigation_wrapper" class="grid_2">
				<ul id="left_navigation">
					<li><a href="#" class="active">Overview</a></li>
                    {if $isLoggedIn == true}
                        <li><a href="/profile/main">Profile</a></li>
                    {/if}
					<li><a href="/tourney/main">Tournaments</a></li>
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
        <div class="Footer">Stompfest Tournament Manager was designed and written by Brad Worrell-Smith, David Estes and Ron Rebennack</div

    </body>
</html>