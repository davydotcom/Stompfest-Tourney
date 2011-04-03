<script>
    var xA_UserID;
    var xTourneyID;

    $(function()
        {
        $("#xDI_PickupPlayers").dialog(
            {
            modal: true,
            width: 500,
            hide: "Fold",
            show: "Fold",
            autoOpen: false,
            resizable: false,
            buttons:
                {
                "Close": PU_CloseInvite,
                "Invite Players": PU_InvitePlayers
                }
            });
        });

    function PU_PickupPlayers(iTourneyID)
        {
        $.ajax(
            {
            url: "/tourney/team/GetPickupPlayers/" + iTourneyID,
            type: "POST",
            success: function(iData){ PU_DoneGotsPickPlayas(iData); }
            });
        }

    function PU_DoneGotsPickPlayas(iData)
        {
        var xDude = jQuery.parseJSON(iData);

        xA_UserID = xDude.Data;
        xTourneyID = xDude.tourneyID;

        $("#xTE_PickupPlayers").find("tr:gt(0)").remove();
        $("#xTE_PickupPlayers").append(xDude.HTML);

        $("#xDI_PickupPlayers").dialog("open");
        }

    function PU_CloseInvite()
        {
        $("#xDI_PickupPlayers").dialog("close");
        }

    function PU_InvitePlayers()
        {
        var xA_Pick = new Array();
        var xTeamID = $("#teamID").val();

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

alert(xTeam);

        $.ajax(
            {
            url: "/tourney/team/InvitePlayers",
            data: "xPicks=" + xA_Pick + "&xTeamID=" + xTeamID + "&xTourneyID=" + xTourneyID,
            type: "POST",
            success: function(iData){ PU_DoneDidInvites(iData); }
            });
        }

    function PU_DoneDidInvites(iData)
        {
        if ( iData == "GOOD" )
            {
            alert("The selected players have been invited to your team.");
            PU_CloseInvite();
            }
        }
</script>

<div id="xDI_PickupPlayers" title="Stompfest Tournament">
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
