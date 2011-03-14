{extends file="layouts/admin/application.tpl"}
{block name=title}Edit User | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Edit user</h2>
    <hr />

    <form class="sf_form" action="/admin/users/update/{$user->userID}" method="post">
        {include file="admin/users/_form.tpl" user=$user}

        <input type="submit" value="Save User."/> or <a href="/admin/users/show/{$user->userID}">cancel</a>
    </form>


{/block}
