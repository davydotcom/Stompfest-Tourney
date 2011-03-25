{extends file="layouts/admin/application.tpl"}
{block name=title}Add Game Map | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>New Map For: {$game->name}</h2>
    <hr />

    <form class="sf_form" action="/admin/games/create_map/{$game->gameID}" method="post">
        {include file="admin/games/maps/_form.tpl"}

        <input type="submit" value="Create Map."/> or <a href="/admin/games/show/{$game->gameID}">cancel</a>
    </form>


{/block}
