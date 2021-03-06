<!DOCTYPE html>
<html>
	<head>
		<title>{block name=title}Stompfest Tournament Manager{/block}</title>

        <link href="/stylesheets/blitzer/jquery-ui.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="/stylesheets/960.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="/stylesheets/application.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="/stylesheets/temp.css" media="screen" rel="stylesheet" type="text/css" />

        <script SRC="/javascripts/JQuery.js"></script>
        <script SRC="/javascripts/jquery-ui.js"></script>
        <script SRC="/javascripts/MaskedInput.js"></script>
        <script SRC="/javascripts/SF.js"></script>
	</head>

	<body>
		<div id="header">
			<ul id="user_navigation">
                {if $isLoggedIn == true}
                    <li><a href="/login/main/destroy">Logout</a></li>
                {else}
                    <li><a href="/login/main">Login</a></li>
                {/if}
			</ul>
            <h1 onclick="location.href='/'">Stompfest <span class="smaller_header">Tournament Manager</span></h1>
		</div>

                {if isset($flashNotice)}
                    <div id="xFlashNotice" class="flash notice">
                        <p>{$flashNotice}</p>
                    </div>

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
					<li><a href="/" {if empty($CurrPage)}class="active"{/if}>Home</a></li>
                    {if $isLoggedIn == true}
                        <li><a href="/profile/main" {if $CurrPage == "profile"}class="active"{/if}>Profile</a></li>
                    {/if}
					<li><a href="/tourney/main" {if $CurrPage == "tourney"}class="active"{/if}>Tournaments</a></li>
					<li><a href="#" {if $CurrPage == "support"}class="active"{/if}>Support</a></li>
				</ul>
			</div>
			<div id="main_content_wrapper" class="grid_10">
				<div id="main_content">
					<div id="main_content_left">
						{block name=main_content}{/block}
					</div>
					<div id="main_content_right">
						{block name=main_content_right}{/block}
					</div>
                                    <br style="clear:both;"/>
				</div>
            <div class="Footer">Stompfest Tournament Manager was designed and written by Brad Worrell-Smith, David Estes and Ron Rebennack</div>
			</div>
                    <br style="clear:both;"/>
		</div>

        
    </body>
</html>