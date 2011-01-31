{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: My Teams{/block}

{block name=main_content_right}
    {include file="profile/links.tpl" xPage="Team"}
{/block}

{block name=main_content}
<script>
	$(function()
        {
        $("#xAccMain").accordion(
            {
			collapsible: true,
            active: false
            });
        });
</script>

{if empty($MyTeams)}
    <div class="GamerNoTourney">You are not a member of any team.</div>
{else}
    <div id="xAccMain">
        {foreach $MyTeams as $xTeam}
            <h3><a href="#">{$xTeam->showName}</a></h3>
            <div>
                <table width="100%">
                    {if !empty($xTeam->ReggyAt)}
                        <tr>
                            <td class="DataLabel">Registration:</td>
                            <td>{$xTeam->ReggyAt}</td>
                        </tr>
                    {/if}
                    {if !empty($xTeam->playersPerTeam)}
                        <tr>
                            <td class="DataLabel">Players per Team:</td>
                            <td>{$xTeam->playersPerTeam}</td>
                        </tr>
                    {/if}
                </table>
            </div>
        {/foreach}
    </div>
{/if}
{/block}