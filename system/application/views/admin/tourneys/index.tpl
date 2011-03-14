{extends file="layouts/admin/application.tpl"}
{block name=title}Tournament | Stompfest Tournament Manager{/block}
{block name=main_content_right}
    <ul id="contextual_actions">
        <li><a href="/admin/tourneys/add">Create New Tournament</a></li>
    </ul>
{/block}
{block name=main_content}


    <h2>Tournaments</h2>

    <hr />
    <table class="admin_table" cellpadding="2">
        <thead>
            <tr>

            <th>Name</th>
            <th>Game</th>
            <th>Type</th>
            <th>Time</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
    {foreach $tourneys as $tourney}
            <tr>

                
                <td><a href="tourneys/show/{$tourney->tourneyID}">{$tourney->name}</a></td>
                <td>{$tourney->game->name}</td>
                <td>{$tourney->tourneyType}</td>
                <td><a href="tourneys/edit/{$tourney->tourneyID}">edit</a> | <a href="tourneys/destroy/{$tourney->tourneyID}" data-confirm="Are you sure you wish to remove this tournament from the server?">remove</a></td>
            </tr>
    {/foreach}
        </tbody>
        <tfoot>
        </tfoot>
      </table>

{/block}
