{extends file="layouts/admin/application.tpl"}
{block name=title}Edit Game | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Edit Game</h2>
    <hr />

    <form class="sf_form" action="/admin/games/update/{$game->gameID}" method="post">
        {include file="admin/games/_form.tpl" game=$game}

        <input type="submit" value="Save game."/> or <a href="/admin/games/show/{$game->gameID}">cancel</a>
    </form>


{/block}
