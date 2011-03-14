{extends file="layouts/admin/application.tpl"}
{block name=title}Users | Stompfest Tournament Manager{/block}
{block name=main_content_right}
    <ul id="contextual_actions">
        <li><a href="/admin/users/add">Create New user</a></li>
    </ul>
{/block}
{block name=main_content}


    <h2>users</h2>

    <hr />
    <table class="admin_table" cellpadding="2">
        <thead>
            <tr>

            <th>Handle</th>
            <th>Barcode</th>
            <th>Email</th>
            <th>Super Admin</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
    {foreach $users as $user}
            <tr>


                <td><a href="users/show/{$user->userID}">{$user->handle}</a></td>
                <td>{$user->barcode}</td>
                <td>{$user->eMail}</td>
                <td>{if $user->is_super_admin == 1}Yes{else}No{/if}</td>
                <td><a href="users/edit/{$user->userID}">edit</a> | <a href="users/destroy/{$user->userID}" data-confirm="Are you sure you wish to remove this user?">remove</a></td>
            </tr>
    {/foreach}
        </tbody>
        <tfoot>
        </tfoot>
      </table>

{/block}
