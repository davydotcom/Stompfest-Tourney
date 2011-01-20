{extends file="layouts/admin/application.tpl"}
{block name=title}Stompfest Tournament: Game - {$game->short_name}{/block}
{block name=main_content_right}

{/block}
{block name=main_content}
<span class="right_floated"><a href="/admin/games/edit/{$game->gameID}">edit</a> | <a href="/admin/games/destroy/{$game->gameID}">remove</a></span>
    <h2>Game - {$game->name}</h2>
<<<<<<< HEAD
    <span class="right_floated"><a href="/admin/games/edit/{$game->gameID}">edit</a> | <a href="/admin/games/delete/{$game->gameID}">remove</a></span>
=======
    
>>>>>>> 771039689ca30bd3932adc4a2fb5719f1180746b

    <hr />
    <p><label>Short Name: </label> {$game->short_name}</p>
    <p><label>Genre: </label> {$game->genre}</p>

    <p><label>Description: </label><br/>
        {$game->description}
    </p>

{/block}
