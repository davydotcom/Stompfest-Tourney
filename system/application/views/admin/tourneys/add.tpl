{extends file="layouts/admin/application.tpl"}
{block name=title}New Tournament | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>New Tournament</h2>
    <hr />

    <form class="sf_form" action="/admin/tourneys/create" method="post">
        {include file="admin/tourneys/_form.tpl" games=$games}

        <input type="submit" value="Create new tournament."/> or <a href="/admin/tourneys">cancel</a>
    </form>


{/block}
