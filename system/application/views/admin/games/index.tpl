{extends file="layouts/admin/application.tpl"}
{block name=title}Games Management | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}


    <h2>Games</h2>
    <a href="/admin/games/add" class="right_floated">Create New Game</a>
    <hr />
    {foreach $games as $game}
        <p><a href="games/show/{$game->gameID}">{$game->name}</a></p>
    {/foreach}

{/block}
