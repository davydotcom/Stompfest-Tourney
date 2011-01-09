{extends file="layouts/application.tpl"}
{block name=title}Games Management | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Games</h2>
    <hr />
    {foreach $games as $game}
        <p>{$game->name}</p>
    {/foreach}

{/block}
