{extends file="layouts/admin/application.tpl"}
{block name=title}Add User Info Field | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>New Game Field: {$game->name}</h2>
    <hr />

    <form class="sf_form" action="/admin/games/create_info/{$game->gameID}" method="post">
        {include file="admin/games/info/_form.tpl"}

        <input type="submit" value="Create new Field."/> or <a href="/admin/games/show/{$game->gameID}">cancel</a>
    </form>


{/block}
