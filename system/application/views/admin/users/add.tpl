{extends file="layouts/admin/application.tpl"}
{block name=title}New User | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>New User</h2>
    <hr />

    <form class="sf_form" action="/admin/users/create" method="post">
        {include file="admin/users/_form.tpl"}

        <input type="submit" value="Create new User."/> or <a href="/admin/users">cancel</a>
    </form>


{/block}
