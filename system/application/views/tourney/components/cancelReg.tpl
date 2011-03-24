<script>
var xID;

$(function()
    {
    $("#xDisbandTeam").dialog(
        {
        modal: true,
        width: 350,
        hide: "Fold",
        show: "Fold",
        autoOpen: false,
        resizable: false,
        buttons:
            {
            "Close": RegClose,
            "Disband this Team": RegDisbandTeam
            }
        });

    $("#xConCancel").dialog(
        {
        modal: true,
        width: 350,
        hide: "Fold",
        show: "Fold",
        autoOpen: false,
        resizable: false,
        buttons:
            {
            "Close": RegClose,
            "Cancel my Registration": RegCancel
            }
        });
    });

function ConfirmCancel(iTourneyID)
    {
    xID = iTourneyID;

    $("#xConCancel").dialog("open");
    }

function ConfirmDisband(iTourneyID)
    {
    xID = iTourneyID;

    $("#xDisbandTeam").dialog("open");
    }

function RegDisbandTeam()
    {
    var xTeam = $("#teamID_" + xID).val();
    var xTour = $("#tourneyID_" + xID).val();

    window.location.href = "/tourney/team/Disband/" + xTour + "/" + xTeam;;
    }

function RegCancel()
    {
    var xTTID = $("#TTID_" + xID).val();

    window.location.href = "/tourney/main/cancelReggy/" + xID + "/" + xTTID;
    }

function RegClose()
    {
    $("#xConCancel").dialog("close");
    $("#xDisbandTeam").dialog("close");
    }
</script>

<div id="xDisbandTeam" name="xDisbandTeam" title="Stompfest Tournament">
    <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to disband this team?
</div>

<div id="xConCancel" name="xConCancel" title="Stompfest Tournament">
    <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to cancel your registration for this Tournament?
</div>
