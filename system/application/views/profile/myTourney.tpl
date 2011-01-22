{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: My Tournaments{/block}

{block name=main_content_right}
    {include file="profile/links.tpl" xPage="Tourney"}
{/block}

{block name=main_content}
{if empty($MyTourney)}
    <div class="GamerNoTourney">You have not registered for any tournaments.</div>
{else}
    {foreach $MyTourney as $xTourney}
        <div class="GamerTourney">
            {$xTourney->name}
            {if $xTourney->lookingForTeam == 0}
                
            {else}
                <p>Looking for a Team... <a href="/profile/myTourney/dropOut/{$xTourney->tourneyID}">Cancel</a></p>
            {/if}
        </div>
    {/foreach}
{/if}
{/block}