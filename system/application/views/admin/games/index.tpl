{extends file="layouts/admin/application.tpl"}
{block name=title}Games Management | Stompfest Tournament Manager{/block}
{block name=main_content_right}
    <ul id="contextual_actions">
        <li><a href="/admin/games/add">Create New Game</a></li>
    </ul>
{/block}
{block name=main_content}


    <h2>Games</h2>
    
    <hr />
    {foreach $games as $game}
        <p><a href="games/show/{$game->gameID}">{$game->name}</a></p>
    {/foreach}

{/block}
