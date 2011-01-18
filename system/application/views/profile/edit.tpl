{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament | {$UserData.handle}{/block}

{block name=main_content_right}
<ul>
    <li><b>Edit Profile</b></li>
    {if !empty($UserData.IAmCaptain)}
        <li><a href="/profile/myTeams">My Teams</a></li>
    {/if}
    <li><a href="/profile/myTourney">My Tournaments</a></li>
</ul>
{/block}

{block name=main_content}
<script>
    function AbleNotify()
        {
        var xCell = $("#xTB_NoteSMS:checked").val();
        var xMail = $("#xTB_NoteEMail:checked").val();

        $("#eMail").attr("disabled", xMail == undefined);
        $("#cellNumber").attr("disabled", xCell == undefined);
        $("#cellCarrier").attr("disabled", xCell == undefined);
        }

    function SetupStuff()
        {
        jQuery(function($)
            {
            $("#cellNumber").mask("(999) 999-9999");
            });
        }

    $(document).ready(SetupStuff());

</script>

<form method="post" action="/profile/update">
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
                        <td><input type="checkbox" id="xTB_NoteEMail" {if !empty($UserData.eMail)}checked{/if} onchange="AbleNotify();" /></td>
                        <td><label for="xTB_NoteEMail">E-Mail</label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="text" id="eMail" name="eMail" value="{$UserData.eMail}" maxlength="100" size="40" {if empty($UserData.eMail)}disabled="disabled"{/if}></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" id="xTB_NoteSMS" {if !empty($UserData.cellNumber)}checked{/if} onchange="AbleNotify();" /></td>
                        <td><label for="xTB_NoteSMS">Text Message</label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="text" id="cellNumber" name="cellNumber" value="{$UserData.cellNumber}" maxlength="12" size="10" {if empty($UserData.cellNumber)}disabled="disabled"{/if}>
                            <select id="cellCarrier" name="cellCarrier" {if empty($UserData.cellNumber)}disabled="disabled"{/if}>
                                <option value="ATT" {if $UserData.cellCarrier == "ATT"}selected{/if}>AT&amp;T</option>
                                <option value="Verizon" {if $UserData.cellCarrier == "Verizon"}selected{/if}>Verizon</option>
                                <option value="Sprint" {if $UserData.cellCarrier == "Sprint"}selected{/if}>Sprint</option>
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
            <td colspan="2" align="center"><input type="submit" value="Save" title="Save my changes" class="MyButton"></td>
        </tr>
    </table>
</form>
{/block}