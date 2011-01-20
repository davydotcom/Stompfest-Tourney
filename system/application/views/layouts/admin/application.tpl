<!DOCTYPE html>
<html>
	<head>
		<title>{block name=title}Admin | Stompfest Tournament Manager{/block}</title>

		<link href="/stylesheets/960.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="/stylesheets/application.css" media="screen" rel="stylesheet" type="text/css" />
        <script LANGUAGE="JavaScript" SRC="/javascripts/JQuery.js"></script>
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
			<h1>Stompfest <span class="smaller_header">Administrator</span></h1>
		</div>
                {if isset($flashNotice)}
                    <div class="flash notice">
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
					<li><a href="/admin/" class="{if $controllerName == 'Overview'}active{/if}">Overview</a></li>
					<li><a href="/admin/tourneys" class="{if $controllerName == 'Tourneys'}active{/if}">Tournaments</a></li>
					<li><a href="/admin/games"  class="{if $controllerName == 'Games'}active{/if}">Games</a></li>
                                        <li><a href="/admin/servers" class="{if $controllerName == 'Servers'}active{/if}">Servers</a></li>
                                        <li><a href="/admin/users">Users</a></li>
                                        <li><a href="/admin/announcements">Announcements</a></li>
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
			</div>
		</div>
	</body>

</html>