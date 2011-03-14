{extends file="layouts/admin/application.tpl"}
{block name=title}New Announcement | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>New Announcement</h2>
    <hr />

    <form class="sf_form" action="/admin/announcements/create" method="post">
        {include file="admin/announcements/_form.tpl"}

        <input type="submit" value="Create new announcement."/> or <a href="/admin/announcements">cancel</a>
    </form>


{/block}
