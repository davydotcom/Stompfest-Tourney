{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournaments{/block}
{block name=main_content}
    {foreach $Tourneys as $xTouney}
        <div>{$xTouney->name}</div>
    {/foreach}
{/block}