{extends file="layouts/admin/application.tpl"}
{block name=title}Games Management | Stompfest Tournament Manager{/block}
{block name=main_content_right}
    <ul id="contextual_actions">
        <li><a href="/admin/games/add">Create New Game</a></li>
    </ul>
{/block}
{block name=main_content}


    <h2>Games</h2>
    
    <hr />
    <table class="admin_table" cellpadding="2">
        <thead>
            <tr>
            
            <th>Abbr.</th>
            <th>Name</th>
            <th>Genre</th>
            <th>Active</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
    {foreach $games as $game}
            <tr>
                
                <td>{$game->short_name}</td>
                <td><a href="games/show/{$game->gameID}">{$game->name}</a></td>
                <td>{$game->genre}</td>
                <td>{if $game->active == 1}Active{else}Inactive{/if}</td>
                <td><a href="games/edit/{$game->gameID}">edit</a> | <a href="games/destroy/{$game->gameID}">remove</a></td>
            </tr>
        <p></p>
    {/foreach}
        </tbody>
        <tfoot>
        </tfoot>
      </table>

{/block}
