{extends file="layouts/admin/application.tpl"}
{block name=title}Server Management | Stompfest Tournament Manager{/block}
{block name=main_content_right}
    <ul id="contextual_actions">
        <li><a href="/admin/servers/add">Create New Server</a></li>
    </ul>
{/block}
{block name=main_content}


    <h2>Servers</h2>

    <hr />
    {foreach $servers as $server}
        <p><a href="servers/show/{$server->serverID}">{$server->name}</a></p>
    {/foreach}

{/block}
