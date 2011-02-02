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

    function RemoveMe(iTTID)
        {
        var xDel = confirm("For rizzle?");
        if ( !xDel )
            return;

        $.ajax(
            {
            url: "/profile/myTeams/RemoveMe/" + iTTID,
            type: "POST",
            success: function(iData){ DoneBeenRemoved(iData); }
            });
        }

    function DoneBeenRemoved(iData)
        {
        if ( iData == "GOOD" )
            {
            window.location.reload();
            return;
            }

        alert("Failed to removed you from this Tournement");
        }

    function RemoveTeamMember(iTTID)
        {
        var xDel = confirm("For rizzle?");
        if ( !xDel )
            return;

        $.ajax(
            {
            url: "/tourney/team/RemoveTeamMember/" + iTTID,
            type: "POST",
            success: function(iData){ DoneDidDelete(iData); }
            });
        }

    function DoneDidDelete(iData)
        {
        $("#xTR_M" + iData).remove();
        }

    function SaveTeam()
        {
        var xData = "tourneyID=%I%&teamID=%T%&teamName=%N%&teamURL=%U%&Captain=%C%";

        xData = xData.replace("%C%", $("input:radio[name=xRG_Cap]:checked").val());
        xData = xData.replace("%I%", $("#tourneyID").val());
        xData = xData.replace("%N%", $("#teamName").val());
        xData = xData.replace("%T%", $("#teamID").val());
        xData = xData.replace("%U%", $("#teamURL").val());

        $.ajax(
            {
            url: "/tourney/team/SaveChanges",
            data: xData,
            type: "POST",
            success: function(iData){ DoneDidSave(iData); }
            });
        }

    function DoneDidSave(iData)
        {
        //  TODO: Make a fancy popup balloon

        if ( iData == "CAP" )
            {
            window.location.reload();
            return;
            }

        if ( iData == "GOOD" )
            alert("Team data has been updated");
        else
            alert(iData);
        }
</script>

{if empty($MyTeams)}
    <div class="GamerNoTourney">You are not a member of any team.</div>
{else}
    <div id="xAccMain">
        {foreach $MyTeams as $xTeam}
            <h3><a href="#">{$xTeam->showName}</a></h3>
            <div>
                <form method="POST">
                    <input type="hidden" id="teamID" name="teamID" value="{$xTeam->teamID}" />
                    <input type="hidden" id="tourneyID" name="tourneyID" value="{$xTeam->tourneyID}" />

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
                            <tr><td colspan="2"><hr /></td></tr>
                            <tr>
                                <td class="DataLabel">Team Name:</td>
                                <td>
                                    {if $xTeam->IAmTeamCaptain == 1 && $xTeam->locked == 0}
                                        <input type="text" id="teamName" name="teamName" value="{$xTeam->teamName}" maxlength="50" size="50" />
                                    {else}
                                        {$xTeam->teamName}
                                    {/if}
                                </td>
                            </tr>
                            <tr>
                                <td class="DataLabel">Team URL:</td>
                                <td>
                                    {if $xTeam->IAmTeamCaptain == 1 && $xTeam->locked == 0}
                                        <input type="text" id="teamURL" name="teamURL" value="{$xTeam->teamURL}" maxlength="125" size="50" />
                                    {else}
                                        {if empty($xTeam->teamURL)}
                                            &nbsp;
                                        {else}
                                            <a href="{$xTeam->teamURL}" target="_blank">{$xTeam->teamURL}</a>
                                        {/if}
                                    {/if}
                                </td>
                            </tr>
                            <tr>
                                <td class="DataLabel">Members:</td>
                                <td>
                                    <table width="100%" class="DG" border="1">
                                        <thead>
                                            <th>Handle</th>
                                            <th>&nbsp;</th>
                                        </thead>
                                        <tbody>
                                            {foreach $xTeam->Members as $xMember}
                                                <tr id="xTR_M{$xMember->TTID}">
                                                    <td>{$xMember->handle}</td>
                                                    <td>
                                                        {if $xMember->IsCaptain == 1}
                                                            <img src="/images/Captain.png" title="Captain" />
                                                            {if $xTeam->IAmTeamCaptain == 1}
                                                                <input type="radio" id="xRB_M0" name="xRG_Cap" value="0" checked>
                                                            {/if}
                                                        {/if}
                                                        {if $xTeam->IAmTeamCaptain == 1 && $xMember->IsCaptain == 0}
                                                            <a href="Javascript:RemoveTeamMember('{$xMember->TTID}');"><img src="/images/Delete.png" border="0" title="Remove this Gamer from my Team" /></a>
                                                            <input type="radio" id="xRB_M{$xMember->userID}" name="xRG_Cap" value="{$xMember->userID}">
                                                            <label for="xRB_M{$xMember->userID}">Make team captain</label>
                                                        {/if}
                                                        {if $xMember->ThisIsMe == 1}
                                                            <a href="Javascript:RemoveMe('{$xMember->TTID}');"><img src="/images/Delete.png" border="0" title="Remove me from this Team" /></a>
                                                        {/if}
                                                    </td>
                                                </tr>
                                            {/foreach}
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            {if $xTeam->IAmTeamCaptain == 1 && $xTeam->locked == 0}
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="button" value="Save" title="Save my changes" onclick="Javascript:SaveTeam();" class="MyButton" />
                                    </td>
                                </tr>
                            {/if}
                    </table>
                </form>
            </div>
        {/foreach}
    </div>
{/if}
{/block}