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
            <table width="100%">
                <tr>
                    <td><b>{$xTourney->showName}</b></td>
                    <td align="right">
                        {if $xTourney->lookingForTeam == 0}
                        {else}
                            Looking for a Team... <a href="/profile/myTourney/dropOut/{$xTourney->tourneyID}">Cancel</a>
                        {/if}
                    </td>
                </tr>
            </table>
        </div>
    {/foreach}
{/if}
{/block}