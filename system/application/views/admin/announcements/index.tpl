{extends file="layouts/admin/application.tpl"}
{block name=title}Announcements | Stompfest Tournament Manager{/block}
{block name=main_content_right}
    <ul id="contextual_actions">
        <li><a href="/admin/announcements/add">Create New Announcement</a></li>
    </ul>
{/block}
{block name=main_content}


    <h2>Announcements</h2>

    <hr />
    <table class="admin_table" cellpadding="2">
        <thead>
            <tr>

            <th>Title</th>
            <th>Posted By</th>
            <th>Created</th>
            <th>Active</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
    {foreach $announcements as $announcement}
            <tr>


                <td><a href="announcements/show/{$announcement->announcementID}">{$announcement->subject}</a></td>
                <td>{$announcement->user->handle}</td>
                <td>{$announcement->createdAt}</td>
                <td>{if $announcement->active == 1}Active{else}Inactive{/if}</td>
                <td><a href="announcements/edit/{$announcement->announcementID}">edit</a> | <a href="announcements/destroy/{$announcement->announcementID}" data-confirm="Are you sure you wish to remove this announcement?">remove</a></td>
            </tr>
    {/foreach}
        </tbody>
        <tfoot>
        </tfoot>
      </table>

{/block}
