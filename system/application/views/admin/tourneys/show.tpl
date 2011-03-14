{extends file="layouts/admin/application.tpl"}
{block name=title}Stompfest Tournament: {$tourney->name}{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
<span class="right_floated"><a href="/admin/tourneys/edit/{$tourney->tourneyID}">edit</a> | <a href="/admin/tourneys/destroy/{$tourney->tourneyID}" data-confirm="Are you sure you want to remove this tournament?">remove</a></span>
<h2>Tournament - {$tourney->name}</h2>

<hr />
<p><label>Type: </label> {if $tourney->tourneyType == 0}Free for All{elseif $tourney->tourneyType == 1}Team Based{else}1 vs. 1{/if}</p>
<p><label>Game: </label> {$tourney->game->name}</p>

<p><label>Description: </label><br/>
        {$tourney->description}
</p>
<p><label>Match Instructions: </label><br/>
        {$tourney->matchInstructions}
</p>



{/block}
