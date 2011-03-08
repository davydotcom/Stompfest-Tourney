{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: My Tournaments{/block}

{block name=main_content_right}
    {include file="profile/links.tpl" xPage="Tourney"}
{/block}

{block name=main_content}
<script>
    var xA_UserID;
    var xTourneyID;

	$(function()
        {
        $("#xPickupPlayers").dialog(
            {
            modal: true,
            width: 500,
            hide: "Fold",
            show: "Fold",
            autoOpen: false,
            resizable: false,
            buttons:
                {
                "Close": CloseInvite,
                "Invite Players": InvitePlayers
                }
            });

        $("#xAccMain").accordion(
            {
			collapsible: true,
            active: false
            });
        });

    function PickupPlayers(iTourneyID)
        {
        $.ajax(
            {
            url: "/tourney/team/GetPickupPlayers/" + iTourneyID,
            type: "POST",
            success: function(iData){ DoneGotsPickPlayas(iData); }
            });
        }

    function DoneGotsPickPlayas(iData)
        {
        var xDude = jQuery.parseJSON(iData);

        xA_UserID = xDude.Data;
        xTourneyID = xDude.tourneyID;

        $("#xTE_PickupPlayers").find("tr:gt(0)").remove();
        $("#xTE_PickupPlayers").append(xDude.HTML);

        $("#xPickupPlayers").dialog("open");
        }

    function CloseInvite()
        {
        $("#xPickupPlayers").dialog("close");
        }

    function InvitePlayers()
        {
        var xA_Pick = new Array();
        var xTeamID = $("#teamID_" + xTourneyID).val();

        for ( xlp = 0; xlp < xA_UserID.length; xlp++ )
            {
            if ( $("#xPUDude_" + xA_UserID[xlp]).attr("checked") == true )
                xA_Pick.push(xA_UserID[xlp]);
            }

        if ( xA_Pick.length == 0 )
            {
            alert("You must select at least one player to invite");
            return;
            }

        $.ajax(
            {
            url: "/tourney/team/InvitePlayers",
            data: "xPicks=" + xA_Pick + "&xTeamID=" + xTeamID + "&xTourneyID=" + xTourneyID,
            type: "POST",
            success: function(iData){ DoneDidInvites(iData); }
            });
        }

    function DoneDidInvites(iData)
        {
        if ( iData == "GOOD" )
            {
            alert("The selected players have been invited to your team.");
            CloseInvite();
            }
        }

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

    function SaveTeam(iTourneyID)
        {
        var xCap = "xRG_Cap_" + iTourneyID;
        var xData = "tourneyID=%I%&teamID=%T%&teamName=%N%&teamURL=%U%";

        xData = xData.replace("%I%", $("#tourneyID_" + iTourneyID).val());
        xData = xData.replace("%N%", $("#teamName_" + iTourneyID).val());
        xData = xData.replace("%T%", $("#teamID_" + iTourneyID).val());
        xData = xData.replace("%U%", $("#teamURL_" + iTourneyID).val());

        xCap = $("input[name='xRG_Cap_" + iTourneyID + "']:checked").val();

        if ( xCap != 0 )
            xData = xData + "&Captain=" + xCap;

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

    function SaveLooking(iTourneyID)
        {
        var xData = "TTID=%TID%&Comment=%COM%";

        xData = xData.replace("%TID%", $("#TTID_" + iTourneyID).val());
        xData = xData.replace("%COM%", $("#xIN_Comm_" + iTourneyID).val())

        $.ajax(
            {
            url: "/profile/myTourney/SaveLooking",
            data: xData,
            type: "POST",
            success: function(iData){ LookingBeSaved(iData); }
            });
        }

    function LookingBeSaved(iData)
        {
        //  TODO: Make a fancy popup balloon

        if ( iData == "GOOD" )
            alert("Team data has been updated");
        else
            alert(iData);
        }

    function InviteAccept(iTourneyID, iTeam)
        {
        $.ajax(
            {
            url: "/tourney/team/JoinTeam",
            data: "tourneyID=" + iTourneyID + "&teamID=" + iTeam,
            type: "POST",
            success: function(){ window.location.href = "/profile/main"; }
            });
        }

    function InviteDecline(iTourneyID, iTeam)
        {
        $.ajax(
            {
            url: "/tourney/team/InviteDecline",
            data: "tourneyID=" + iTourneyID + "&teamID=" + iTeam,
            type: "POST",
            success: function(){ window.location.href = "/profile/main"; }
            });
        }
</script>

{if empty($MyTourneys)}
    <div class="GamerNoTourney">You are not registered for any tournaments.</div>
{else}
    {include file="components/cancelReg.tpl"}

    <div id="xPickupPlayers" name="xPickupPlayers" title="Stompfest Tournament">
        <table id="xTE_PickupPlayers" name="xTE_PickupPlayers" width="100%" class="DG" border="1">
            <thead>
                <tr>
                    <th>Invite</th>
                    <th>Handle</th>
                    <th>Comment</th>
                </tr>
            </thead>
        </table>
    </div>

    <div id="xAccMain">
        {foreach $MyTourneys as $xTourn}
            <h3><a href="#">{$xTourn->showName}</a></h3>
            <div>
                <form id="xF_T{$xTourn->tourneyID}" name="xF_T{$xTourn->tourneyID}" method="POST" action="Javascript:SaveTeam('{$xTourn->tourneyID}');">
                    <input type="hidden" id="TTID_{$xTourn->tourneyID}" name="TTID_{$xTourn->tourneyID}" value="{$xTourn->TTID}" />
                    <input type="hidden" id="tourneyID_{$xTourn->tourneyID}" name="tourneyID_{$xTourn->tourneyID}" value="{$xTourn->tourneyID}" />

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