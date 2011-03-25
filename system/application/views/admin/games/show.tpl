{extends file="layouts/admin/application.tpl"}
{block name=title}Stompfest Tournament: Game - {$game->short_name}{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
<span class="right_floated"><a href="/admin/games/edit/{$game->gameID}">edit</a> | <a href="/admin/games/destroy/{$game->gameID}">remove</a></span>
<h2>Game - {$game->name}</h2>

<hr />
<p><label>Short Name: </label> {$game->short_name}</p>
<p><label>Genre: </label> {$game->genre}</p>

<p><label>Description: </label><br/>
        {$game->description}
</p>

<h3>User Information</h3>

<hr/>
<a href="/admin/games/add_info/{$game->gameID}">Add User Field</a>
<table class="admin_table" cellpadding="2">
    <thead>
        <tr>
            <th>Reqrd</th>
            <th>Name</th>
            <th>Default</th>
            <th>Global</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $gamer_infos as $gamer_info}
            <tr>
                
                <td>{if $gamer_info->required == 1}Yes{else}No{/if}</td>
                <td>{$gamer_info->name}</td>
                <td>{$gamer_info->defaultValue}</td>
                <td>{if $gamer_info->globalField == 1}Global{else}Game Specific{/if}</td>
                <td><a href="/admin/games/edit_info/{$gamer_info->gameID}/{$gamer_info->gameGamerInfoID}">edit</a> | <a href="/admin/games/delete_info/{$gamer_info->gameGamerInfoID}">remove</a></td>
            </tr>
    {/foreach}
    </tbody>
    <tfoot>
    </tfoot>
</table>

<h3>Game Maps</h3>

<hr/>
<a href="/admin/games/add_map/{$game->gameID}">Add Map</a>
<table class="admin_table" cellpadding="2">
    <thead>
        <tr>
            <th>Name</th>
            <th>Short Name</th>
            <th>Official</th>
            <th>Max.</th>
            <th>Active</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $game_maps as $game_map}
            <tr>
                
                
                <td>{$game_map->name}</td>
                <td>{$game_map->shortName}</td>

                <td>{if $game_map->official == 1}Official{else}Unofficial{/if}</td>
                <td>{$game_map->maxPlayers}</td>
                <td>{if $game_map->active == 1}Yes{else}No{/if}</td>
                <td><a href="/admin/games/edit_info/{$gamer_info->gameID}/{$gamer_info->gameGamerInfoID}">edit</a> | <a href="/admin/games/delete_info/{$gamer_info->gameGamerInfoID}">remove</a></td>
            </tr>
    {/foreach}
    </tbody>
    <tfoot>
    </tfoot>
</table>

{/block}
