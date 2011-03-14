{extends file="layouts/admin/application.tpl"}
{block name=title}Edit Game | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Edit Game Field: {$game->name}</h2>
    <hr />

    <form class="sf_form" action="/admin/games/update_info/{$game_gamer_info->gameGamerInfoID}" method="post">
        {include file="admin/games/info/_form.tpl" game_gamer_info=$game_gamer_info}

        <input type="submit" value="Save Field."/> or <a href="/admin/games/show/{$game->gameID}">cancel</a>
    </form>


{/block}
