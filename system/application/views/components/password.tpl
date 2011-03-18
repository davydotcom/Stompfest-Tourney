<script>

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
            "Close": NoPassword,
            "Save Password": SavePassword
            }
        });
    });

    function GetPassword()
        {
        $("#xDI_Password").dialog("open");
        }

    function NoPassword()
        {
        $("#xDI_Password").dialog("close");
        }

    function SavePassword()
        {
        alert("AJAX stuff here");
        }
</script>

<div id="xDI_Password" name="xDI_Password" title="Stompfest Tournament">
    <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
    <table>
        {if $xShowCurrent}
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
