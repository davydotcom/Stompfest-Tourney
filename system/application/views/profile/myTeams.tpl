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

    function RemoveFromTeam(iTTID)
        {
        var xDel = confirm("For rizzle?");
        if ( !xDel )
            return;

        $.ajax(
            {
            url: "/tourney/team/RemoveFromTeam/" + iTTID,
            type: "POST",
            success: function(iData){ DoneDidDelete(iData); }
            });
        }

    function DoneDidDelete(iData)
        {
        $("#xTR_M" + iData).remove();
        }
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
                    {foreach $xTeam->Members as $xMember}
                        <tr>
                            <td class="DataLabel">Members:</td>
                            <td>
                                <table width="100%" class="DG" border="1">
                                    <thead>
                                        <th>Handle</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        <tr id="xTR_M{$xMember->TTID}">
                                            <td>{$xMember->handle}</td>
                                            <td>
                                                {if !empty($xMember->IsCaptain)}<img src="/images/Captain.png" title="Captain" />{/if}
                                                {if !empty($xTeam->IAmTeamCaptain)}<a href="Javascript:RemoveFromTeam('{$xMember->TTID}');"><img src="/images/Delete.png" border="0" title="Remove this Gamer from my Team" /></a>{/if}
                                                {/if}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="2">Honk... Something just ain't right!</td>
                        </tr>
                    {/foreach}
                </table>
            </div>
        {/foreach}
    </div>
{/if}
{/block}