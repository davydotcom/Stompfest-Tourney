{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Login{/block}

{block name=main_content}
    <h2>Login</h2>
    <hr />

    <div class="LoginMain">
        <div class="GroupBox LoginCurrent">
            <form action="/login/main/validate" method="post">
                <table>
                    <tr>
                        <td colspan="2" class="LoginTitle">Existing User<br /><hr /></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Handle:</td>
                        <td><input type="text" name="xCurrHandle" value="" maxlength="30" size="20"/></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Password:</td>
                        <td><input type="text" name="xPass" value="" maxlength="10" size="10" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit" value="Login" title="Login" size="15" class="MyButton"/></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="GroupBox LoginNew">
            <form action="/login/main/create" method="post">
                <table>
                    <tr>
                        <td colspan="2" class="LoginTitle">New User<br /><hr /></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Handle:</td>
                        <td><input type="text" name="xNewHandle" value="" maxlength="30" size="20"/></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Barcode:</td>
                        <td>
                            <input type="text" name="xBarcode" value="" maxlength="10" size="10" />
                            <a href="" title="Where is my Barcode?"><img src="/images/Help.png" title="Barcode?" border="0" /></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit" value="Create" title="Login" size="15" class="MyButton"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
{/block}