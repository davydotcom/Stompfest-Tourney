{extends file="layouts/admin/application.tpl"}
{block name=title}New Game | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>New Game</h2>
    <hr />

    <form class="sf_form" action="/admin/games/create" method="post">
        {include file="admin/games/_form.tpl"}

        <input type="submit" value="Create new game."/> or <a href="/admin/games">cancel</a>
    </form>


{/block}
