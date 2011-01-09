
{extends file="layouts/application.tpl"}
{block name=title} Login | Stompfest Tourney Manager{/block}
{block name=main_content}
    <h2>Login</h2>
    <hr />
    <form action="/login/validate" method="post">
    <table>
        <tr>
            <td class="DataLabel">Handle:</td>
            <td><input type="text" name="xHandle" value="" maxlength="30" size="30"/></td>
        </tr>
        <tr>
            <td class="DataLabel">Barcode:</td>
            <td><input type="text" name="xBarcode" value="" maxlength="10" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="Login" title="Login" size="15" class="MyButton"/></td>
        </tr>
    </table>
    </form>
{/block}