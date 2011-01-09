{extends file="layouts/admin/application.tpl"}
{block name=title}Game - {$game->short_name} | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Game - {$game->name}</h2>
    <span class="right_floated"><a href="/admin/games/edit/{$game->gameID}">edit</a> | <a href="/admin/games/destroy/{$game->gameID}">remove</a></span>

    <hr />
    <p><label>Short Name: </label> {$game->short_name}</p>
    <p><label>Genre: </label> {$game->genre}</p>

{/block}
