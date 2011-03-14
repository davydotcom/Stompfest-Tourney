{extends file="layouts/admin/application.tpl"}
{block name=title}Stompfest Announcement: {$announcement->name}{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
<span class="right_floated"><a href="/admin/announcements/edit/{$announcement->announcementID}">edit</a> | <a href="/admin/announcements/destroy/{$announcement->announcementID}" data-confirm="Are you sure you want to remove this announcement?">remove</a></span>
<h2>Announcement - {$announcement->subject}</h2>

<hr />

<p><label>Content: </label><br/>
        {$announcement->content}
</p>
<p><label>Posted On: </label> {$announcement->createdAt}</p>
<p><label>User: </label> {$announcement->user->handle}</p>


{/block}
