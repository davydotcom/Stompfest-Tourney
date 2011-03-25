{extends file="/layouts/application.tpl"}

{block name=title}Stompfest Tournament: Tournament List{/block}

{block name=main_content_right}
    {if $ListType == "User"}
        {include file="/profile/links.tpl" xPage="Tourney"}
    {/if}
{/block}

{block name=main_content}
<script>
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

    function TourneyShow(iTourneyID)
        {
        $.ajax(
            {
            url: "/tourney/main/view/" + iTourneyID,
            type: "POST",
            success: function(iData){ TourneyShowItDude(iData); }
            });
        }

    function TourneyShowItDude(iData)
        {
        $("#TourneyDetail").html(iData);
        }
</script>

    {if $ListType == "User"}
        <h2>{$UserData->handle}</h2>
        <hr />
        {if empty($Tourneys)}
            <div class="GamerNoTourney">You are not registered for any tournaments.</div>
        {/if}
    {/if}

    {include file="/tourney/components/cancelReg.tpl"}
    {if $isLoggedIn == true}
        {if $UserData->IAmCaptain}
            {include file="/tourney/components/pickupPlayers.tpl"}
        {/if}
    {/if}

    {foreach $Tourneys as $xTourney}
        {OutID tourneyID={$xTourney->tourneyID}}

        <a href="Javascript:TourneyShow('{$xTourney->tourneyID}');"><img src="/images/Tourney/{$xTourney->photo_file_name}" title="{$xTourney->ShowName}" /></a>
    {/foreach}

    <div id="TourneyDetail"></div>
{/block}