{extends file="layouts/application.tpl"}

{block name=title}Stompfest Tournament: Login{/block}

{block name=main_content}

{include file="/components/password.tpl" xShowCurrent="false"}

<script>
    function Login()
        {
        var xHand = $("#xCurrHandle");
        var xPass = $("#xPass");

        $("#xBarcode").val("");
        $("#xNewHandle").val("");

        if ( IsEmpty(xHand.val()) )
            {
            alert("Handle is required");

            xHand.focus();
            return;
            }

        if ( IsEmpty(xPass.val()) )
            {
            alert("Password is required");

            xPass.focus();
            return;
            }

        $.ajax(
            {
            url: "/login/main/validate/",
            data: "xHandle=" + xHand.val() + "&xPass=" + xPass.val(),
            type: "POST",
            success: function(iData){ LoginValidated(iData); }
            });
        }

    function LoginValidated(iData)
        {
        if ( iData == "GOOD" )
            {
            window.location = "/main";
            return;
            }

        alert(iData);
        }

    function Create()
        {
        var xBar = $("#xBarcode");
        var xHand = $("#xNewHandle");

        $("#xPass").val("")
        $("#xCurrHandle").val("");

        if ( IsEmpty(xHand.val()) )
            {
            alert("Handle is required");

            xHand.focus();
            return;
            }

        if ( IsEmpty(xBar.val()) )
            {
            alert("Barcode is required");

            xBar.focus();
            return;
            }

        $.ajax(
            {
            url: "/login/main/create/",
            data: "xHandle=" + xHand.val() + "&xBar=" + xBar.val(),
            type: "POST",
            success: function(iData){ CreateGotRDone(iData); }
            });
        }

    function CreateGotRDone(iData)
        {
        if ( iData != "GOOD" )
            {
            alert(iData);
            return;
            }

        PasswordGet(DoneDidPassword);
        }

    function DoneDidPassword()
        {
        window.location = "/profile/main/edit";
        }
</script>

<h2>Login</h2>
    <hr />

    <div class="LoginMain">
        <div class="GroupBox LoginCurrent">
            <form action="Javascript:Login();" method="post">
                <table>
                    <tr>
                        <td colspan="2" class="LoginTitle">Existing User<br /><hr /></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Handle:</td>
                        <td><input type="text" id="xCurrHandle" name="xCurrHandle" value="" maxlength="30" size="20"/></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Password:</td>
                        <td><input type="text" id="xPass" name="xPass" value="" maxlength="10" size="10" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit" value="Login" title="Login" class="MyButton"/></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="GroupBox LoginNew">
            <form action="Javascript:Create();" method="post">
                <table>
                    <tr>
                        <td colspan="2" class="LoginTitle">New User<br /><hr /></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Handle:</td>
                        <td><input type="text" id="xNewHandle" name="xNewHandle" value="" maxlength="30" size="20"/></td>
                    </tr>
                    <tr>
                        <td class="DataLabel">Barcode:</td>
                        <td>
                            <input type="text" id="xBarcode" name="xBarcode" value="" maxlength="10" size="10" />
                            <a href="" title="Where is my Barcode?"><img src="/images/Help.png" title="Barcode?" border="0" /></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit" value="Create" title="Login" class="MyButton"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
{/block}