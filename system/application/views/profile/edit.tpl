{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament | {$UserData.handle}{/block}

{block name=main_content_right}
<ul>
    <li><a href="/profile/edit">Edit Profile</a></li>
    <li><a href="">My Teams</a></li>
    <li><a href="">My Tournaments</a></li>
</ul>
{/block}

{block name=main_content}
<script>
    function AbleNotify()
        {
        var xWho = $("input[name='Notify']:checked").val();

        $("#xIN_Cell").attr("disabled", xWho != "S");
        $("#xCB_Carry").attr("disabled", xWho != "S");
        $("#xIN_EMail").attr("disabled", xWho != "E");
        }
</script>

<form method="post" action="profile/update">
    <table class="DataDisplay">
        <tr>
            <td class="DataLabel">Handle:</td>
            <td>{$UserData.handle}</td>
        </tr>
        <tr>
            <td class="DataLabel">Barcode:</td>
            <td>{$UserData.barcode}</td>
        </tr>
        <tr>
            <td class="DataLabel">Tournament Notification:</td>
            <td>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td><input type="radio" id="xRB_NoteNone" value="N" name="Notify" {if $UserData.notification == 0}checked{/if} onchange="AbleNotify();" /></td>
                        <td><label for="xRB_NoteNone"><b>None</b></label></td>
                    </tr>
                    <tr>
                        <td><input type="radio" id="xRB_NoteEMail" value="E" name="Notify" {if $UserData.notification == 1}checked{/if} onchange="AbleNotify();" /></td>
                        <td><label for="xRB_NoteEMail">E-Mail</label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="text" id="xIN_EMail" value="{$UserData.eMail}" maxlength="100" size="40"></td>
                    </tr>
                    <tr>
                        <td><input type="radio" id="xRB_NoteSMS" value="S" name="Notify" {if $UserData.notification == 2}checked{/if} onchange="AbleNotify();" /></td>
                        <td><label for="xRB_NoteSMS">Text Message</label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="text" id="xIN_Cell" value="{$UserData.cellNumber}" maxlength="12" size="10">
                            <select id="xCB_Carry">
                                <option value="ATT">AT&amp;T</option>
                                <option value="Verizon">Verizon</option>
                                <option value="Sprint">Sprint</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr /></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Save" title="Save my changes" class="MyButton"></td>
        </tr>
    </table>
</form>
{/block}