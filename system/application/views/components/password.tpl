<script>
var xPassCallBack;

$(function()
    {
    $("#xDI_Password").dialog(
        {
        modal: true,
        width: 350,
        hide: "Fold",
        show: "Fold",
        autoOpen: false,
        resizable: false,
        buttons:
            {
            "Close": PasswordClose,
            "Save Password": PasswordSave
            }
        });
    });

function PasswordGet(iCallBack)
    {
    xPassCallBack = iCallBack;

    $("#xIN_PasswordNew").val("");
    $("#xIN_PasswordConfirm").val("");
    $("#xIN_PasswordCurrent").val("");

    $("#xDI_Password").dialog("open");
    }

function PasswordClose()
    {
    $("#xDI_Password").dialog("close");
    }

function PasswordSave()
    {
    var xPass = $("#xIN_PasswordNew").val();
    var xConf = $("#xIN_PasswordConfirm").val();
    var xCurr = $("#xIN_PasswordCurrent").val();

    if ( xConf != xPass )
        {
        alert("Password and confirmation password do not match");
        return;
        }

    $.ajax(
        {
        url: "/profile/main/savePassword",
        data: "xCurr=" + xCurr + "&xPass=" + xPass,
        type: "POST",
        success: function(iData){ PasswordBack(iData); }
        });
    }

function PasswordBack(iData)
    {
    if ( iData == "GOOD" )
        {
        NoPassword();

        xPassCallBack.call();
        return;
        }

    alert(iData);
    }

</script>

<div id="xDI_Password" title="Stompfest Tournament">
    <table>
        {if $xShowCurrent === true}
            <tr>
                <td class="DataLabel">Current Password:</td>
                <td><input type="password" id="xIN_PasswordCurrent" name="xIN_PasswordCurrent"></td>
            </tr>
        {/if}
        <tr>
            <td class="DataLabel">New Password:</td>
            <td><input type="password" id="xIN_PasswordNew" name="xIN_PasswordNew"></td>
        </tr>
        <tr>
            <td class="DataLabel">Confirm Password:</td>
            <td><input type="password" id="xIN_PasswordConfirm" name="xIN_PasswordConfirm"></td>
        </tr>
    </table>
</div>
