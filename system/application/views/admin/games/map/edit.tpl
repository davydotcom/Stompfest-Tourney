{extends file="layouts/admin/application.tpl"}
{block name=title}Edit Game Map | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Edit Map For: {$game->name}</h2>
    <hr />

    <form class="sf_form" action="/admin/games/update_map/{$game_map->gameMapID}" method="post">
        {include file="admin/games/map/_form.tpl" game_map=$game_map}

        <input type="submit" value="Save Game Map."/> or <a href="/admin/games/show/{$game->gameID}">cancel</a>
    </form>


{/block}
