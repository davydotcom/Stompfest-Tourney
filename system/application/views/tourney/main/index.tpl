{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournaments{/block}
{block name=main_content}
    {foreach $Tourneys as $xTourney}
        <div class="TourneyList">
            {$xTourney->name}
            {$xTourney->Status}
        </div>
    {/foreach}
{/block}