{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: My Tournaments{/block}

{block name=main_content_right}
    {include file="profile/links.tpl" xPage="Tourney"}
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
            url: "/profile/myTourney/RemoveMe/" + iTTID,
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

{if empty($MyTourneys)}
    <div class="GamerNoTourney">You are not registered for any tournaments.</div>
{else}
    {include file="components/cancelReg.tpl"}

    <div id="xAccMain">
        {foreach $MyTourneys as $xTourn}
            <h3><a href="#">{$xTourn->showName}</a></h3>
            <div>
                <form method="POST">
                    <input type="hidden" id="tourneyID" name="tourneyID" value="{$xTourn->tourneyID}" />

                    <table width="100%">
                        {if !empty($xTourn->ReggyAt)}
                            <tr>
                                <td class="DataLabel">Registration:</td>
                                <td>{$xTourn->ReggyAt}</td>
                            </tr>
                        {/if}
                        {if !empty($xTourn->playersPerTeam)}
                            <tr>
                                <td class="DataLabel">Players per Team:</td>
                                <td>{$xTourn->playersPerTeam}</td>
                            </tr>
                        {/if}
                            <tr><td colspan="2"><hr /></td></tr>
                        {if $xTourn->tourneyType == 1}
                            {include file="profile/team.tpl"}
                        {/if}
                    </table>
                </form>
            </div>
        {/foreach}
    </div>
{/if}
{/block}