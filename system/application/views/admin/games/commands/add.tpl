{extends file="layouts/admin/application.tpl"}
{block name=title}Add Server Command | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>New Server Command For: {$game->name}</h2>
    <hr />

    <form class="sf_form" action="/admin/games/create_command/{$game->gameID}" method="post">
        {include file="admin/games/commands/_form.tpl"}

        <input type="submit" value="Create Command."/> or <a href="/admin/games/show/{$game->gameID}">cancel</a>
    </form>


{/block}
