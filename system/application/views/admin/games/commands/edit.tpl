{extends file="layouts/admin/application.tpl"}
{block name=title}Edit Game Command | Stompfest Tournament Manager{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
    <h2>Edit Server Command For: {$game->name}</h2>
    <hr />

    <form class="sf_form" action="/admin/games/update_command/{$game_server_command->gameServerCommandID}" method="post">
        {include file="admin/games/commands/_form.tpl" game_server_command=$game_server_command}

        <input type="submit" value="Save Command."/> or <a href="/admin/games/show/{$game->gameID}">cancel</a>
    </form>


{/block}
