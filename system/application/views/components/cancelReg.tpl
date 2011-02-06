<script>
$(function()
    {
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
            "Close": NeverMind,
            "Cancel my Registration": CancelReg
            }
        });
    });

function ConfirmCancel()
    {
    $("#xConCancel").dialog("open");
    }

function CancelReg()
    {
    window.location.href = '/tourney/main/cancelReggy/' + $("#TourneyID").val();
    }

function NeverMind()
    {
    $("#xConCancel").dialog("close");
    }
</script>

<div id="xConCancel" name="xConCancel" title="Stompfest Tournament">
    <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to cancel your registration for this Tournament?
</div>
