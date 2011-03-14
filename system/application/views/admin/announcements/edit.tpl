{extends file="layouts/admin/application.tpl"}
{block name=title}Edit Announcement | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Edit Announcement</h2>
    <hr />

    <form class="sf_form" action="/admin/announcements/update/{$announcement->announcementID}" method="post">
        {include file="admin/announcements/_form.tpl" announcement=$announcement}

        <input type="submit" value="Save Announcement."/> or <a href="/admin/announcements/show/{$announcement->announcementID}">cancel</a>
    </form>


{/block}
