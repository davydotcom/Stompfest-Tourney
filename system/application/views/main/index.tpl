{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament Manager{/block}

{block name=main_content}
<h2>Welcome!</h2>
<p>Welcome to the Stompfest Tournament manager, and to the Stompfest event for that matter! This is where you can register for tournaments throughout the event as well as get notified of event announcements.</p>

{foreach $announcements as $announcement}

	<div class="announcement">
		<h3>{$announcement->subject}</h3>
		<span class="announcement_content">
		{$announcement->content}
		</span>
		<span class="announcement_meta">Posted by: {$announcement->user->handle} at {$announcement->createdAt}</span>
	</div>
{/foreach}
{/block}