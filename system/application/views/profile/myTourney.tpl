{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: My Tournaments{/block}

{block name=main_content_right}
    {include file="profile/links.tpl" xPage="Tourney"}
{/block}

{block name=main_content}
{if empty($MyTeams)}
    <div class="GamerNoTourney">You have not registered for any tournaments.</div>
{else}
    {foreach $MyTeams as $xTeam}
        <div class="GamerTourney">
            {$xTeam.name}
            {if $xTeam.lookingForTeam == 0}
                
            {else}
                <p>Looking for a Team... <a href="/profile/myTourney/dropOut/{$xTeam.tourneyID}">Cancel</a></p>
            {/if}
        </div>
    {/foreach}
{/if}
{/block}