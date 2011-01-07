
{extends file="layouts/application.tpl"}
{block name=title} Login | Stompfest Tourney Manager{/block}
{block name=main_content}
    <h2>Login</h2>
    <form action="/login/validate" method="post">
        <input type="text" name="xHandle" value="" maxlength="30" size="30"/>
        <input type="text" name="xBarcode" value="" maxlength="10"/>
        <input type="submit" name="submit" value="Login"/>
    </form
{/block}