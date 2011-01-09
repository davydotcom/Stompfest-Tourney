{extends file="layouts/application.tpl"}
{block name=title}Stompfest Tournament | {$Handle}{/block}
{block name=main_content_right}
<ul>
    <li><a href="/profile/edit">Edit Profile</a></li>
    <li><a href="">My Teams</a></li>
    <li><a href="">My Tournaments</a></li>
</ul>
{/block}
{block name=main_content}
<form method="post" action="profile/update">
    <table>
        <tr>
            <td class="DataLabel">Handle:</td>
            <td>{$Handle}</td>
        </tr>
        <tr>
            <td class="DataLabel">Barcode:</td>
            <td>{$Barcode}</td>
        </tr>
        <tr>
            <td class="DataLabel">Tournament Notification:</td>
            <td>
                <input type="radio" id="xRB_NoteNone" name="Notify" /><label for="xRB_NoteNone"><b>None</b></label><br />
                <input type="radio" id="xRB_NoteEMail" name="Notify" /><label for="xRB_NoteEMail">E-Mail</label><br/>
                <input type="radio" id="xRB_NoteSMS" name="Notify" /><label for="xRB_NoteSMS">Text Message</label>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="Instructions">Optional, you can have Stompfest send you an E-Mail or a text message to your phone to notify you when your tournament is about to start. Your normal text/data plan charges may apply.</td>
        </tr>
        <tr>
            <td class="DataLabel">Handle:</td>
            <td>{$Handle}</td>
        </tr>
    </table>
</form>
{/block}